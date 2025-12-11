@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.facture.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.factures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.facture.fields.id') }}
                        </th>
                        <td>
                            {{ $facture->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.facture.fields.reference') }}
                        </th>
                        <td>
                            {{ $facture->reference }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.facture.fields.montant') }}
                        </th>
                        <td>
                            {{ $facture->montant }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.facture.fields.status') }}
                        </th>
                        <td>
                            {{ $facture->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.facture.fields.comment') }}
                        </th>
                        <td>
                            {{ $facture->comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.facture.fields.user') }}
                        </th>
                        <td>
                            {{ $facture->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.factures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#facture_paiements" role="tab" data-toggle="tab">
                {{ trans('cruds.paiement.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="facture_paiements">
            @includeIf('admin.factures.relationships.facturePaiements', ['paiements' => $facture->facturePaiements])
        </div>
    </div>
</div>

@endsection