@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.soin.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.soins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>

                <div class="form-group float-right">
                    <a class="btn btn-success" href="{{ route('admin.soins.print', $soin->id) }}">
                        <i class="fa fa-print" aria-hidden="true"></i>
                        {{ trans('global.print') }}
                    </a>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.soin.fields.id') }}
                        </th>
                        <td>
                            {{ $soin->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.soin.fields.reference') }}
                        </th>
                        <td>
                            {{ $soin->reference }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.soin.fields.montant') }}
                        </th>
                        <td>
                            {{ $soin->montant }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.soin.fields.patient') }}
                        </th>
                        <td>
                            {{ $soin->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.soin.fields.medecin') }}
                        </th>
                        <td>
                            {{ $soin->medecin->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.soin.fields.user') }}
                        </th>
                        <td>
                            {{ $soin->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.soins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.soinDetail.title') }}
    </div>
    <div class="tab-content">
        @includeIf('admin.soins.relationships.soinDetails', ['soinDetails' => $soin->details])
    </div>
</div>

@endsection