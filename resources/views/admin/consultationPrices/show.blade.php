@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.consultationPrice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.consultation-prices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.consultationPrice.fields.type') }}
                        </th>
                        <td>
                            {{ $consultationPrice->type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultationPrice.fields.medecin') }}
                        </th>
                        <td>
                            {{ $consultationPrice->medecin->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultationPrice.fields.tarif') }}
                        </th>
                        <td>
                            {{ $consultationPrice->tarif }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultationPrice.fields.user') }}
                        </th>
                        <td>
                            {{ $consultationPrice->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.consultation-prices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection