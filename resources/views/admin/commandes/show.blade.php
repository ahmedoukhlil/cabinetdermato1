@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.commande.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.commande.fields.id') }}
                        </th>
                        <td>
                            {{ $commande->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commande.fields.reference') }}
                        </th>
                        <td>
                            {{ $commande->reference }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commande.fields.montant_total') }}
                        </th>
                        <td>
                            {{ number_format($commande->montant_total, 0, '.', ' ') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commande.fields.montant_paye') }}
                        </th>
                        <td>
                            {{ number_format($commande->montant_paye, 0, '.', ' ') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('global.created_at') }}
                        </th>
                        <td>
                            {{ $commande->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commande.fields.user') }}
                        </th>
                        <td>
                            {{ $commande->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.commandes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.commandeDetail.title') }}
    </div>
    <div class="tab-content">
        @includeIf('admin.commandes.relationships.commandeCommandeDetails', ['commandeDetails' => $commande->commandeCommandeDetails])
    </div>
</div>

@endsection