@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <form method="POST" action="{{ route("admin.factures.filter") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="card border-success mb-3">
                        <div class="card-header bg-success text-white h4">
                            Montant facturé
                        </div>
                        <div class="card-body text-danger">
                            <h2 align='center'>{{number_format($sumInvoices, 0, '.', ' ')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card border-info mb-3">
                        <div class="card-header bg-info text-white h4">
                            Filtre de factures
                        </div>
                        <div class="card-body text-info">
                            <div class="row">
                                <div class="col">
                                    <label class="font-weight-bold" for="invoice_from_date">{{ trans('global.period') }}</label> : 
                                    <input type="text" value="{{$invoice_from_date }}" class="form-control date datepicker" name="invoice_from_date" id="invoice_from_date"/>
                                    <input type="text" value="{{$invoice_to_date }}" class="form-control date datepicker" name="invoice_to_date" id="invoice_to_date"/>
                                </div>
                                <div class="col">
                                    <label class="font-weight-bold" for="status_id">{{ trans('cruds.facture.fields.status') }}</label> : 
                                    <select name="status_id" id="status_id" class=" form-control">
                                        @foreach($status as $id => $lib)
                                        <option value="{{ $id }}" {{ $status_id == $id ? 'selected' : '' }}>{{ $lib }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="font-weight-bold" for="invoice_type">{{ trans('cruds.facture.fields.type_facture') }}</label> : 
                                    <select name="invoice_type" id="status_id" class=" form-control">
                                        @foreach($invoiceType as $id => $lib)
                                        <option value="{{ $id }}" {{ $invoice_type == $id ? 'selected' : '' }}>{{ $lib }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <br/>
                                    <button class="btn btn-info pull-left" type="submit">
                                        {{ trans('global.validate') }}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Facture">
            <thead>
                <tr>
                    <th>{{ trans('cruds.facture.fields.reference') }}</th>
                    <th>{{ trans('cruds.facture.fields.montant') }}</th>
                    <th>{{ trans('cruds.facture.fields.montant_encaisse') }}</th>
                    <th>{{ trans('cruds.facture.fields.type_facture') }}</th>
                    <th>{{ trans('cruds.facture.fields.status') }}</th>
                    <th>{{ trans('global.created_at') }}</th>
                    <th>{{ trans('cruds.facture.fields.user') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->reference}}</td>
                    <td>{{ $invoice->montant}}</td>
                    <td>{{ $invoice->montant_encaisse}}</td>
                    <td>@lang($invoice->factureable->facture_type)</td>
                    <td>{{ $invoice->status->name ?? ''}}</td>
                    <td>{{ $invoice->created_at}}</td>
                    <td>{{ $invoice->user->full_name ?? ''}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
