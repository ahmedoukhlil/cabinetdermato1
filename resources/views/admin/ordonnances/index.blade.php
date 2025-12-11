@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route("admin.ordonnances.index") }}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3">
                    <div class="card border-success mb-3">
                        <div class="card-header bg-success text-white h4">
                            Nombre d'ordonnance
                        </div>
                        <div class="card-body text-danger">
                            <h2 align='center'>{{number_format($ordonnances->count(), 0, '.', ' ')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card border-info mb-3">
                        <div class="card-header bg-info text-white h4">
                            Filtre des ordonnances
                        </div>
                        <div class="card-body text-info">
                            <div class="row">
                                <div class="col">
                                    <label class="font-weight-bold" for="ordonnance_from_date">{{ trans('global.period') }}</label> : 
                                    <input type="text" value="{{$ordonnance_from_date }}" class="form-control date datepicker" name="ordonnance_from_date" id="ordonnance_from_date"/>
                                    <input type="text" value="{{$ordonnance_to_date }}" class="form-control date datepicker" name="ordonnance_to_date" id="ordonnance_to_date"/>
                                </div>
                                <div class="col-2">
                                    <br/>
                                    <button class="btn btn-info pull-left" type="submit">
                                        {{ trans('global.validate') }}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        @if($ordonnances->count())
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Ordonnance">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.ordonnance.fields.patient') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordonnance.fields.medecin') }}
                    </th>
                    <th>{{ trans('global.created_at') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordonnances as $ordonnance)
                <tr>
                    <td>{{$ordonnance->patient->full_name}}</td>
                    <td>{{$ordonnance->medecin->full_name}}</td>
                    <td>{{$ordonnance->created_at}}</td>
                    <td>
                        @includeIf('partials.datatablesActions', [ 'row'=>$ordonnance, 'viewGate' => 'ordonnance_show', 'editGate' => 'ordonnance_edit', 'deleteGate' => 'ordonnance_delete', 'crudRoutePart' => 'ordonnances'])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection