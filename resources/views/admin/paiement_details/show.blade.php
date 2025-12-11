@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paiementDetails.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.paiements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paiementDetails.fields.id') }}
                        </th>
                        <td>
                            {{ $paiement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paiementDetails.fields.facture') }}
                        </th>
                        <td>
                            {{ $paiement->facture->montant ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paiementDetails.fields.reference') }}
                        </th>
                        <td>
                            {{ $paiement->reference }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paiementDetails.fields.montant') }}
                        </th>
                        <td>
                            {{ $paiement->montant }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paiementDetails.fields.user') }}
                        </th>
                        <td>
                            {{ $paiement->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.paiements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection