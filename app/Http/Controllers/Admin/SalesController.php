<?php

namespace App\Http\Controllers\Admin;

use App\Sale;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySaleRequest;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class SalesController extends Controller {

    public function index() {
        abort_if(Gate::denies('sale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales = Sale::all();

        return view('admin.sales.index', compact('sales'));
    }

    public function create() {
        abort_if(Gate::denies('sale_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = \App\Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $articles = \App\Article::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $patients = \App\Patient::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sales.create', compact('categories', 'articles', 'patients'));
    }

    public function store(StoreSaleRequest $request) {
//        return dd($request->all());
//        DB::enableQueryLog();
        $cmd = $request->all();
        if (trim($cmd['reference']) == '') {
            $cmd['reference'] = 'Vente/Articles/' . $cmd['patient_id'] . '/' . date('YmdHis');
        }
        DB::beginTransaction();
        $total = 0;
        $line = 1;
        $sale = Sale::create($cmd + ['montant' => $total, 'user_id' => Auth::user()->id]);
        foreach ($request->input('sale_details', []) as $data) {
            $montant = $data['quantity'] * $data['prix_unitaire'];
            if ($montant <= 0) {
                DB::rollback();
                return redirect()->back()->withErrors("Merci de vérifier la ligne {$line} Quantité ou Prix Unitaire incorrect")->withInput();
            }
            $line += 1;
            $total += $montant;
            $sale->saleDetails()->create($data + ['montant_total' => $montant]);
            $updated = array('quantity' => DB::raw("quantity - {$data['quantity']}"));
            \App\Article::where('id', $data['article_id'])->update($updated);
        }
        $verifQtt = true;
        $rupture = array();
        foreach ($request->input('sale_details', []) as $data) {
            $article = \App\Article::find($data['article_id']);
            if ($article->quantity < 0) {
                $verifQtt = false;
                $rupture[] = "Quantité insuffisante de l'article '{$article->name}'";
            }
        }
        if (!$verifQtt) {
            DB::rollback();
            return redirect()->back()->withErrors(implode(" | ", $rupture))->withInput();
        }

        $sale->update(['montant' => $total]);
        $updated = array('ca' => DB::raw("ca + {$total}"), 'solde' => DB::raw("solde + {$total}"));
        \App\Patient::where('id', request('patient_id'))->update($updated);
        $updated = array('solde' => DB::raw("solde + {$total}"));
        \App\CashRegister::where('id', 1)->update($updated);
        \App\Facture::create([
            'montant' => $total,
            'patient_id' => request('patient_id'),
            'factureable_type' => 'App\\Sale',
            'factureable_id' => $sale->id,
            'reference' => 'Inv/Vente/Id/' . $sale->id,
            'user_id' => Auth::user()->id,
        ]);

        if ($total <= 0) {
            DB::rollback();
            return redirect()->back()->withErrors("Montant total de la facture est incorrecte")->withInput();
        }

//        DB::rollback();
//        dd(DB::getQueryLog());
        DB::commit();
        $sale->load('user', 'saleDetails');

        return view('admin.sales.show', compact('sale'));

        return redirect()->route('admin.sales.index');
    }

    public function edit(Sale $sale) {
        abort_if(Gate::denies('sale_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sale->load('user');

        return view('admin.sales.edit', compact('users', 'sale'));
    }

    public function update(UpdateSaleRequest $request, Sale $sale) {
        $sale->update($request->all());

        return redirect()->route('admin.sales.index');
    }
     public function printSale(Sale $sale) {
        abort_if(Gate::denies('sale_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $image = public_path() . '\images\Header.PNG';
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $HeadImage = base64_encode($data);
//        dd($HeadImage);
        ini_set("pcre.backtrack_limit", "5000000");
        $sale->load('user', 'saleDetails');
        $config = ['format' => 'A5-P', 'default_font_size' => 11, 'margin_left' => 2, 'margin_right' => 2, 'margin_top' => 5];
//        return View('admin.sales.print', compact('sale', 'HeadImage'));
        $pdf = PDF::loadView('admin.sales.print', compact('sale', 'HeadImage'), [], $config);
        return $pdf->stream();
    }

    public function show(Sale $sale) {
        abort_if(Gate::denies('sale_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sale->load('user', 'saleDetails');

        return view('admin.sales.show', compact('sale'));
    }

    public function destroy(Sale $sale) {
        abort_if(Gate::denies('sale_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sale->delete();

        return back();
    }

    public function massDestroy(MassDestroySaleRequest $request) {
        Sale::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
