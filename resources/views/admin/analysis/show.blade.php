@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.analysi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.analysis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                <div class="pull pull-right">

                    <a class="btn  btn-success" href="{{ route('admin.analysis.print', $analysi->id) }}">
                        {{ trans('global.print') }}
                    </a>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.analysi.fields.id') }}
                        </th>
                        <td>
                            {{ $analysi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.analysi.fields.reference') }}
                        </th>
                        <td>
                            {{ $analysi->reference }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.analysi.fields.medecin') }}
                        </th>
                        <td>
                            {{ $analysi->medecin->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.analysi.fields.consultation') }}
                        </th>
                        <td>
                            {{ $analysi->consultation->comment ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.analysi.fields.patient') }}
                        </th>
                        <td>
                            {{ $analysi->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.analysi.fields.analysis_comment') }}
                        </th>
                        <td>
                            {!! $analysi->analysis_comment !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.analyseDetail.title_singular') }}
                        </th>
                        <td>
                            @foreach($analysi->analyseAnalyseDetails as $key => $analyseDetail)
                            <span class="label label-info">{{ $analyseDetail->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.analysis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection