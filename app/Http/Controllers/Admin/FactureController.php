<?php

namespace App\Http\Controllers\Admin;

use App\FactureStatus;
use App\Facture;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFactureRequest;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateFactureRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Carbon\Carbon;

class FactureController extends Controller {

    public $type_factures = array('App\Soin' => 'Soins', 'App\Appointment' => 'Consultation', 'App\Sale' => 'Produit');

    public function index(Request $request) {
        abort_if(Gate::denies('facture_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $qry = Facture::whereDate('created_at', Carbon::today());
        $invoices = $qry->with(['status', 'user'])->orderByDesc('id')->get();
        $sumInvoices = $qry->sum('montant');
        $status = FactureStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'));
        $status_id = $invoice_type = '';
        $invoice_from_date = $invoice_to_date = date('d-m-Y');
        $invoiceType = array('' => trans('global.pleaseSelect')) + $this->type_factures;
        return view('admin.factures.index', compact('invoices', 'status', 'status_id', 'sumInvoices', 'invoiceType', 'invoice_type', 'invoice_from_date', 'invoice_to_date'));
    }

    function filter(Request $request) {
//        dd($request->all());
        $status_id = (int) $request->input('status_id');
//        DB::enableQueryLog();
        abort_if(Gate::denies('facture_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $qry = Facture::when(request('invoice_from_date'), function ($q) {
                    return $q->whereDate('created_at', '>=', date('Y-m-d', strtotime(request('invoice_from_date'))));
                })
                ->when(request('invoice_to_date'), function ($q) {
                    return $q->whereDate('created_at', '<=', date('Y-m-d', strtotime(request('invoice_to_date'))));
                })
                ->when(request('invoice_type'), function ($q) {
                    return $q->where('factureable_type', request('invoice_type'));
                })
                ->when(0 != $status_id, function ($q) {
            return $q->where('status_id', '=', request('status_id'));
        });
        $invoices = $qry->orderByDesc('id')->get();
        $sumInvoices = $qry->sum('montant');

        $status = \App\FactureStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $invoice_from_date = request('invoice_from_date');
        $invoice_to_date = request('invoice_to_date');
        $invoiceType = array('' => trans('global.pleaseSelect')) + $this->type_factures;
        $invoice_type = request('invoice_type');
//        dd(DB::getQueryLog());
        return view('admin.factures.index', compact('invoices', 'status_id', 'invoice_type', 'invoice_from_date', 'invoice_to_date', 'status', 'sumInvoices', 'invoiceType'));
    }

    public function create() {
        abort_if(Gate::denies('facture_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.factures.create');
    }

    public function store(StoreFactureRequest $request) {
        $facture = Facture::create($request->all());

        return redirect()->route('admin.factures.index');
    }

    public function edit(Facture $facture) {
        abort_if(Gate::denies('facture_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facture->load('status', 'user');

        return view('admin.factures.edit', compact('facture'));
    }

    public function update(UpdateFactureRequest $request, Facture $facture) {
        $facture->update($request->all());

        return redirect()->route('admin.factures.index');
    }

    public function show(Facture $facture) {
        abort_if(Gate::denies('facture_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facture->load('status', 'user', 'facturePaiements');

        return view('admin.factures.show', compact('facture'));
    }

    public function destroy(Facture $facture) {
        abort_if(Gate::denies('facture_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facture->delete();

        return back();
    }

    public function massDestroy(MassDestroyFactureRequest $request) {
        Facture::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
