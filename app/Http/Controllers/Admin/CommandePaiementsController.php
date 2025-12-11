<?php

namespace App\Http\Controllers\Admin;

use App\CommandePaiement;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommandePaiementRequest;
use App\Http\Requests\UpdateCommandePaiementRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Illuminate\Support\Facades\Auth;

class CommandePaiementsController extends Controller {

    public function index() {
        abort_if(Gate::denies('commande_paiement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiements = CommandePaiement::all();

        return view('admin.commandePaiements.index', compact('paiements'));
    }

    public function destroy(CommandePaiement $commandePaiement) {
        abort_if(Gate::denies('commande_paiement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        dd($commandePaiement->fournisseur_id);
        DB::beginTransaction();
        $fournisseur = \App\Fournisseur::findOrFail($commandePaiement->fournisseur_id);
        $updated = array('solde' => DB::raw("solde + {$commandePaiement['montant']}"));
        $fournisseur->update($updated);
        $commandePaiement->delete();
        DB::commit();

        return back();
    }

}
