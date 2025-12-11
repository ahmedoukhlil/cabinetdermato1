@can('operation_cash_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.operation-cashes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.operationCash.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.operationCash.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-caisseOperationCashes">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.operationCash.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.operationCash.fields.caisse') }}
                        </th>
                        <th>
                            {{ trans('cruds.operationCash.fields.medecin') }}
                        </th>
                        <th>
                            {{ trans('cruds.medecin.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.operationCash.fields.montant') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($operationCashes as $key => $operationCash)
                        <tr data-entry-id="{{ $operationCash->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $operationCash->id ?? '' }}
                            </td>
                            <td>
                                {{ $operationCash->caisse->name ?? '' }}
                            </td>
                            <td>
                                {{ $operationCash->medecin->name ?? '' }}
                            </td>
                            <td>
                                {{ $operationCash->medecin->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $operationCash->montant ?? '' }}
                            </td>
                            <td>
                                @can('operation_cash_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.operation-cashes.show', $operationCash->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('operation_cash_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.operation-cashes.edit', $operationCash->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('operation_cash_delete')
                                    <form action="{{ route('admin.operation-cashes.destroy', $operationCash->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('operation_cash_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.operation-cashes.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-caisseOperationCashes:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection