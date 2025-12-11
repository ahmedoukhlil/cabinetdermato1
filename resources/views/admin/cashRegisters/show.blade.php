@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cashRegister.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cash-registers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cashRegister.fields.id') }}
                        </th>
                        <td>
                            {{ $cashRegister->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cashRegister.fields.name') }}
                        </th>
                        <td>
                            {{ $cashRegister->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cashRegister.fields.solde') }}
                        </th>
                        <td>
                            {{ $cashRegister->solde }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cash-registers.index') }}">
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
            <a class="nav-link" href="#caisse_soins" role="tab" data-toggle="tab">
                {{ trans('cruds.soin.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#caisse_operation_cashes" role="tab" data-toggle="tab">
                {{ trans('cruds.operationCash.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="caisse_soins">
            @includeIf('admin.cashRegisters.relationships.caisseSoins', ['soins' => $cashRegister->caisseSoins])
        </div>
        <div class="tab-pane" role="tabpanel" id="caisse_operation_cashes">
            @includeIf('admin.cashRegisters.relationships.caisseOperationCashes', ['operationCashes' => $cashRegister->caisseOperationCashes])
        </div>
    </div>
</div>

@endsection