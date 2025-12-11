@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fournisseur.title') }}
        
            @if($fournisseur->solde > 0)
            <div class="form-group float-right">
                <a class="btn btn-success" href="{{ route('admin.fournisseurs.paiement', $fournisseur->id) }}">
                    {{ trans('global.payments.title') }}
                </a>
            </div>
            @endif
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fournisseur.fields.id') }}
                        </th>
                        <td>
                            {{ $fournisseur->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fournisseur.fields.name') }}
                        </th>
                        <td>
                            {{ $fournisseur->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fournisseur.fields.phone') }}
                        </th>
                        <td>
                            {{ $fournisseur->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fournisseur.fields.solde') }}
                        </th>
                        <td>
                            {{ number_format($fournisseur->solde, 0, '', ' ') }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fournisseurs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#fournisseur_commandes" role="tab" data-toggle="tab">
                {{ trans('cruds.commande.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#fournisseur_paiements" role="tab" data-toggle="tab">
                {{ trans('cruds.commandePaiements.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="fournisseur_commandes">
            @includeIf('admin.fournisseurs.relationships.commandes', ['commandes' => $fournisseur->commandes])
        </div>
        <div class="tab-pane" role="tabpanel" id="fournisseur_paiements">
            @includeIf('admin.fournisseurs.relationships.paiements', ['commandePaiements' => $fournisseur->paiements])
        </div>
    </div>
</div>
@endsection