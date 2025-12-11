<?php

namespace App\Http\Controllers\Admin;

use App\Commande;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCommandeRequest;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Illuminate\Support\Facades\Auth;

class CommandesController extends Controller {

    public function index() {
        abort_if(Gate::denies('commande_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commandes = Commande::all();

        return view('admin.commandes.index', compact('commandes'));
    }

    public function create() {
        abort_if(Gate::denies('commande_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = \App\Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $articles = \App\Article::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $fournisseurs = \App\Fournisseur::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.commandes.create', compact('categories', 'articles', 'fournisseurs'));
    }

    public function store(StoreCommandeRequest $request) {
        if (!$request->input('commande_details')) {
            return redirect()->back()->withErrors("Détail de la commande est obligatoire")->withInput();
        }
//        DB::enableQueryLog();
        DB::beginTransaction();
        $total = 0;
        $commande = Commande::create($request->all() + ['montant_total' => $total, 'user_id' => Auth::user()->id]);
        foreach ($request->input('commande_details', []) as $data) {
            $montant = $data['quantity'] * $data['prix_unitaire'];
            $total += $montant;
            if ($montant) {
                $commande->commandeCommandeDetails()->create($data + ['montant_total' => $montant]);
                $updated = array('quantity' => DB::raw("quantity + {$data['quantity']}"));
                \App\Article::where('id', $data['article_id'])->update($updated);
            }
        }
        if (!$total) {
            DB::rollback();
            return redirect()->back()->withErrors("Commande ne peut pas être nulle")->withInput();
        }
        $commande->update(['montant_total' => $total]);
        $mnt = $total - $request->all()['montant_paye'];
        $updated = array('solde' => DB::raw("solde + {$mnt}"));
        \App\Fournisseur::where('id', $request->all()['fournisseur_id'])->update($updated);

//        DB::rollback();
//        dd(DB::getQueryLog());
        DB::commit();

        return redirect()->route('admin.commandes.index');
    }

    public function edit(Commande $commande) {
        abort_if(Gate::denies('commande_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $fournisseurs = \App\Fournisseur::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $commande->load('user', 'fournisseur');

        return view('admin.commandes.edit', compact('users', 'commande', 'fournisseurs'));
    }

    public function update(UpdateCommandeRequest $request, Commande $commande) {
        $commande->update($request->all());

        return redirect()->route('admin.commandes.index');
    }

    public function show(Commande $commande) {
        abort_if(Gate::denies('commande_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commande->load('user', 'commandeCommandeDetails', 'fournisseur');

        return view('admin.commandes.show', compact('commande'));
    }

    public function destroy(Commande $commande) {
        abort_if(Gate::denies('commande_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commande->delete();

        return back();
    }

    public function massDestroy(MassDestroyCommandeRequest $request) {
        Commande::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
