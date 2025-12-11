@extends('layouts.admin')
@section('content')
@can('soin_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.soins.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.soin.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route("admin.soins.index") }}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-2">
                    <div class="card border-success mb-3">
                        <div class="card-header bg-success text-white h4">
                            Montant
                        </div>
                        <div class="card-body text-danger">
                            <h2 align='center'>{{number_format($sumSoins, 0, '.', ' ')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="offset-md-1 col-md-9">
                    <div class="card border-info mb-3">
                        <div class="card-header bg-info text-white h4">
                            Filtre de soins
                        </div>
                        <div class="card-body text-info">
                            <div class="row">
                                <div class="col">
                                    <label class="font-weight-bold" for="soin_from_date">{{ trans('global.period') }}</label> : 
                                    <input type="text" value="{{$soin_from_date }}" class="form-control date datepicker" name="soin_from_date" id="soin_from_date"/>
                                    <input type="text" value="{{$soin_to_date }}" class="form-control date datepicker" name="soin_to_date" id="soin_to_date"/>
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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Sale">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.soin.fields.reference') }}
                        </th>
                        <th>
                            {{ trans('cruds.soin.fields.montant') }}
                        </th>
                        <th>
                            {{ trans('cruds.soin.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.soin.fields.medecin') }}
                        </th>
                        <th>
                            {{ trans('cruds.soin.fields.user') }}
                        </th>
                        <th>
                            {{ trans('global.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($soins as $key => $soin)
                        <tr data-entry-id="{{ $soin->id }}">
                            <td>
                                {{ $soin->reference ?? '' }}
                            </td>
                            <td>
                                {{ $soin->montant ?? '' }}
                            </td>
                            <td>
                                {{ $soin->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $soin->medecin->name ?? '' }}
                            </td>
                            <td>
                                {{ $soin->user->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $soin->created_at ?? '' }}
                            </td>
                            <td>
                                @can('soin_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.soins.show', $soin->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('soin_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.soins.edit', $soin->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('soin_delete')
                                    <form action="{{ route('admin.soins.destroy', $soin->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 5, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Sale:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection