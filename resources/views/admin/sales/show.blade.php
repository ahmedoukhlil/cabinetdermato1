@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sale.title') }}

        <div class="form-group float-right">
            <a class="btn btn-success" href="{{ route('admin.sales.print', $sale->id) }}">
                <i class="fa fa-print" aria-hidden="true"></i>
                {{ trans('global.print') }}
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sales.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sale.fields.id') }}
                        </th>
                        <td>
                            {{ $sale->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sale.fields.reference') }}
                        </th>
                        <td>
                            {{ $sale->reference }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sale.fields.montant') }}
                        </th>
                        <td>
                            {{ $sale->montant }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sale.fields.patient') }}
                        </th>
                        <td>
                            {{ $sale->patient->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sale.fields.user') }}
                        </th>
                        <td>
                            {{ $sale->user->full_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sales.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.saleDetail.title') }}
    </div>
    <div class="tab-content">
        @includeIf('admin.sales.relationships.saleDetails', ['saleDetails' => $sale->saleDetails])
    </div>
</div>

@endsection