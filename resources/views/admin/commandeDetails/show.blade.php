@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.commandeDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.commande-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $commandeDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.commande') }}
                        </th>
                        <td>
                            {{ $commandeDetail->commande->reference ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.article') }}
                        </th>
                        <td>
                            {{ $commandeDetail->article->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.quantity') }}
                        </th>
                        <td>
                            {{ $commandeDetail->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.prix_unitaire') }}
                        </th>
                        <td>
                            {{ $commandeDetail->prix_unitaire }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.montant_total') }}
                        </th>
                        <td>
                            {{ $commandeDetail->montant_total }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.commande-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection