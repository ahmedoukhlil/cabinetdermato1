@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.charge.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.charges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.charge.fields.id') }}
                        </th>
                        <td>
                            {{ $charge->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.charge.fields.amount') }}
                        </th>
                        <td>
                            {{ $charge->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.charge.fields.dt_charge') }}
                        </th>
                        <td>
                            {{ $charge->dt_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.charge.fields.description') }}
                        </th>
                        <td>
                            {{ $charge->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.charge.fields.motif') }}
                        </th>
                        <td>
                            {{ $charge->motif->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.charges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection