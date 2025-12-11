@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.type-soin.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.type-soins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.type-soin.fields.id') }}
                        </th>
                        <td>
                            {{ $typeSoin->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.type-soin.fields.name') }}
                        </th>
                        <td>
                            {{ $typeSoin->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.type-soin.fields.prix') }}
                        </th>
                        <td>
                            {{ $typeSoin->prix }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.type-soin.fields.caisse') }}
                        </th>
                        <td>
                            {{ $typeSoin->caisse->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.type-soins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection