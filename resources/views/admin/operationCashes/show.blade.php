@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.operationCash.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.operation-cashes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.operationCash.fields.id') }}
                        </th>
                        <td>
                            {{ $operationCash->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operationCash.fields.caisse') }}
                        </th>
                        <td>
                            {{ $operationCash->caisse->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operationCash.fields.medecin') }}
                        </th>
                        <td>
                            {{ $operationCash->medecin->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operationCash.fields.montant') }}
                        </th>
                        <td>
                            {{ number_format($operationCash->montant, 0, '', ' ') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operationCash.fields.user') }}
                        </th>
                        <td>
                            {{ $operationCash->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.operation-cashes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection