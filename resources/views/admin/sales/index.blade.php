@extends('layouts.admin')
@section('content')
@can('sale_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sales.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.sale.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.sale.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Sale">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.sale.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.sale.fields.reference') }}
                        </th>
                        <th>
                            {{ trans('cruds.sale.fields.montant') }}
                        </th>
                        <th>
                            {{ trans('cruds.sale.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('global.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.sale.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $key => $sale)
                        <tr data-entry-id="{{ $sale->id }}">
                            <td>
                                {{ $sale->id ?? '' }}
                            </td>
                            <td>
                                {{ $sale->reference ?? '' }}
                            </td>
                            <td>
                                {{ $sale->montant ?? '' }}
                            </td>
                            <td>
                                {{ $sale->patient->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $sale->created_at }}
                            </td>
                            <td>
                                {{ $sale->user->full_name ?? '' }}
                            </td>
                            <td>
                                @can('sale_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sales.show', $sale->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('sale_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sales.edit', $sale->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('sale_delete')
                                    <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    order: [[ 1, 'desc' ]],
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