@extends('layouts.admin')
@section('content')
@can('ordonnance_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.ordonnance-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.ordonnanceDetail.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.ordonnanceDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-OrdonnanceDetail">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.ordonnanceDetail.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordonnanceDetail.fields.medicament') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordonnanceDetail.fields.forme') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordonnanceDetail.fields.posologie') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordonnanceDetail.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordonnanceDetail.fields.duration') }}
                    </th>
                    <th>
                        {{ trans('cruds.ordonnanceDetail.fields.ordonnance') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('ordonnance_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.ordonnance-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.ordonnance-details.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'medicament', name: 'medicament' },
{ data: 'forme_name', name: 'forme.name' },
{ data: 'posologie', name: 'posologie' },
{ data: 'quantity', name: 'quantity' },
{ data: 'duration', name: 'duration' },
{ data: 'ordonnance_medicament', name: 'ordonnance.medicament' },
{ data: 'actions', name: '{{ trans('global.actions') }}', "searchable": false  }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-OrdonnanceDetail').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection