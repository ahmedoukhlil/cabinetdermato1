@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ordonnanceDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ordonnance-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ordonnanceDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $ordonnanceDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordonnanceDetail.fields.article') }}
                        </th>
                        <td>
                            {{ $ordonnanceDetail->article->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordonnanceDetail.fields.forme') }}
                        </th>
                        <td>
                            {{ $ordonnanceDetail->article->forme->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordonnanceDetail.fields.posologie') }}
                        </th>
                        <td>
                            {{ $ordonnanceDetail->posologie }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordonnanceDetail.fields.quantity') }}
                        </th>
                        <td>
                            {{ $ordonnanceDetail->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordonnanceDetail.fields.duration') }}
                        </th>
                        <td>
                            {{ $ordonnanceDetail->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordonnanceDetail.fields.ordonnance') }}
                        </th>
                        <td>
                            {{ $ordonnanceDetail->ordonnance->medicament ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ordonnance-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection