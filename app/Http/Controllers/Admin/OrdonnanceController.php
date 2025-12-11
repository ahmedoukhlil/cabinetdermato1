<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrdonnanceRequest;
use App\Http\Requests\StoreOrdonnanceRequest;
use App\Http\Requests\UpdateOrdonnanceRequest;
use App\Ordonnance;
use App\Patient;
use Gate;
use PDF;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;

class OrdonnanceController extends Controller {

    use MediaUploadingTrait;

    public function index(Request $request) {
        abort_if(Gate::denies('ordonnance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->has('ordonnance_from_date')) {
            $ordonnance_from_date = $request->input('ordonnance_from_date');
            $ordonnance_to_date = $request->input('ordonnance_to_date');
            
            $qry = Ordonnance::when(request('ordonnance_from_date'), function ($q) {
                        return $q->whereDate('created_at', '>=', date('Y-m-d', strtotime(request('ordonnance_from_date'))));
                    })
                    ->when(request('ordonnance_to_date'), function ($q) {
                        return $q->whereDate('created_at', '<=', date('Y-m-d', strtotime(request('ordonnance_to_date'))));
                    });
        } else {
            $ordonnance_from_date = $ordonnance_to_date = date('d-m-Y');
            $qry = Ordonnance::whereDate('created_at', '>=', date('Y-m-d', strtotime($ordonnance_from_date)))
                    ->whereDate('created_at', '<=', date('Y-m-d', strtotime($ordonnance_to_date)));
        }
            $ordonnances = $qry->orderByDesc('id')->get();

        return view('admin.ordonnances.index', compact('ordonnances', 'ordonnance_from_date', 'ordonnance_to_date'));
    }

    public function create() {
        abort_if(Gate::denies('ordonnance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $formes = \App\FormeMedicament::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.ordonnances.create', compact('patients', 'formes'));
    }

    public function store(StoreOrdonnanceRequest $request) {
        if ($request->has('ordonnance_details') && count($request->all()['ordonnance_details'])) {
            DB::beginTransaction();
            $ord = array(
                'medecin_id' => Auth::user()->medecins[0]->id,
                'patient_id' => $request->input('patient_id'),
                'reference' => 'Ord/Lib/' . $request->input('patient_id') . '/Medecin/' . Auth::user()->medecins[0]->id,
                'ordonnance_comment' => $request->input('ordonnance_comment')
            );
            $ordonnance = Ordonnance::create($ord);
            foreach ($request->input('ordonnance_details', []) as $data) {
                $ordonnance->ordonnanceOrdonnanceDetails()->create($data);
            }
            DB::commit();
        } else {
            return redirect()->back()->withErrors('Ordonnance doit avoir au moins un médicament')->withInput();
        }
        return redirect()->route('admin.ordonnances.index');
    }

    public function livraison(Ordonnance $ordonnance) {
        abort_if(Gate::denies('ordonnance_livraison'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = \App\Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $articles = \App\Article::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.ordonnances.livraison', compact('categories', 'articles', 'ordonnance'));
    }

    public function livraisonStore(Request $request) {
//        dd($request->all());
        if ($request->has('livraison') && count($request->all()['livraison'])) {
            $ordonnance = Ordonnance::findOrFail($request->input('ordonnance_id'));
            DB::beginTransaction();
            foreach ($request->input('livraison', []) as $data) {
                $ordonnance->livraison()->create($data + ['user_id' => Auth::id()]);
                $updated = array('quantity' => DB::raw("quantity - {$data['quantity']}"));
                \App\Article::where('id', $data['article_id'])->update($updated);
            }

            $verifQtt = true;
            $rupture = array();
            foreach ($request->input('livraison', []) as $data) {
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
            DB::commit();
        } else {
            return redirect()->back()->withErrors('Ordonnance doit avoir au moins un médicament')->withInput();
        }
        return redirect()->route('admin.ordonnances.index');
    }

    public function edit(Ordonnance $ordonnance) {
        abort_if(Gate::denies('ordonnance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $formes = \App\FormeMedicament::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $ordonnance->load('medecin', 'patient', 'consultation');

        return view('admin.ordonnances.edit', compact('ordonnance', 'formes'));
    }

    public function update(UpdateOrdonnanceRequest $request, Ordonnance $ordonnance) {

        $ordonnanceDetails = $ordonnance->ordonnanceOrdonnanceDetails;
        DB::beginTransaction();
        $ordonnance->update($request->all());

        $currentOrdonnanceDetailData = [];
        foreach ($request->input('ordonnance_details', []) as $index => $data) {
            if (is_integer($index)) {
                $ordonnance->ordonnanceOrdonnanceDetails()->create($data);
            } else {
                $id = explode('-', $index)[1];
                $currentOrdonnanceDetailData[$id] = $data;
            }
        }
        foreach ($ordonnanceDetails as $item) {
            if (isset($currentOrdonnanceDetailData[$item->id])) {
                $item->update($currentOrdonnanceDetailData[$item->id]);
            } else {
                $item->delete();
            }
        }
        DB::commit();

        return redirect()->route('admin.ordonnances.index');
    }

    public function show(Ordonnance $ordonnance) {
        abort_if(Gate::denies('ordonnance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordonnance->load('medecin', 'patient', 'consultation', 'ordonnanceOrdonnanceDetails');
//        dd(gettype($ordonnance->ordonnanceOrdonnanceDetails()));
        return view('admin.ordonnances.show', compact('ordonnance'));
    }

    public function printOrdonnance(Ordonnance $ordonnance) {
        abort_if(Gate::denies('ordonnance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $image = public_path() . '\images\header-1.png';
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $HeadImage = base64_encode($data);
        $image = public_path() . '\images\Footer.PNG';
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $FooterImage = base64_encode($data);
//        dd($HeadImage);
        ini_set("pcre.backtrack_limit", "5000000");
        $ordonnance->load('medecin', 'patient', 'consultation', 'ordonnanceOrdonnanceDetails');
        $config = ['format' => 'A5-P', 'default_font_size' => 11, 'margin_left' => 2, 'margin_right' => 2, 'margin_top' => 5];
        //return View('admin.ordonnances.print', compact('ordonnance', 'HeadImage', 'FooterImage'));
        $pdf = PDF::loadView('admin.ordonnances.print', compact('ordonnance', 'HeadImage', 'FooterImage'), [], $config);
        return $pdf->stream();
    }

    public function destroy(Ordonnance $ordonnance) {
        abort_if(Gate::denies('ordonnance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($ordonnance->medicaments_number <= $ordonnance->articles_number) {
            return back()->withErrors("Ordonnance dejà livrée !!");
        }
        $ordonnance->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrdonnanceRequest $request) {
        Ordonnance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request) {
        abort_if(Gate::denies('ordonnance_create') && Gate::denies('ordonnance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Ordonnance();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

}
