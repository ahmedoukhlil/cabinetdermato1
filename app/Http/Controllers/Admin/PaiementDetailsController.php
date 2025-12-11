<?php

namespace App\Http\Controllers\Admin;

use App\Facture;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPaiementDetailRequest;
use App\Http\Requests\StorePaiementDetailRequest;
use App\Http\Requests\UpdatePaiementDetailRequest;
use App\PaiementDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PaiementDetailsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('paiement_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PaiementDetail::with(['facture'])->select(sprintf('%s.*', (new PaiementDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'paiement_detail_show';
                $editGate      = 'paiement_detail_edit';
                $deleteGate    = 'paiement_detail_delete';
                $crudRoutePart = 'paiements';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('facture_montant', function ($row) {
                return $row->facture ? $row->facture->montant : '';
            });
            
            $table->editColumn('montant', function ($row) {
                return $row->montant ? $row->montant : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'facture']);

            return $table->make(true);
        }

        $factures = Facture::get()->pluck('montant')->toArray();

        return view('admin.paiements.index', compact('factures'));
    }

    public function create()
    {
        abort_if(Gate::denies('paiement_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paiements.create');
    }

    public function store(StorePaiementDetailRequest $request)
    {
        $paiement = PaiementDetail::create($request->all());

        return redirect()->route('admin.paiements.index');
    }

    public function edit(PaiementDetail $paiement)
    {
        abort_if(Gate::denies('paiement_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiement->load('facture');

        return view('admin.paiements.edit', compact('paiement'));
    }

    public function update(UpdatePaiementDetailRequest $request, PaiementDetail $paiement)
    {
        $paiement->update($request->all());

        return redirect()->route('admin.paiements.index');
    }

    public function show(PaiementDetail $paiement)
    {
        abort_if(Gate::denies('paiement_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiement->load('facture');

        return view('admin.paiements.show', compact('paiement'));
    }

    public function destroy(PaiementDetail $paiement)
    {
        abort_if(Gate::denies('paiement_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiement->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaiementDetailRequest $request)
    {
        PaiementDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
