@extends('layouts.admin')
@section('content')
@can('patient_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.patients.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.patient.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.patient.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Patient">
            <thead>
                <tr>
                    <th>{{ trans('cruds.patient.fields.name') }}</th>
                    <th>{{ trans('cruds.patient.fields.solde') }}</th>
                    <th>{{ trans('cruds.patient.fields.phone') }}</th>
                    <th>{{ trans('cruds.patient.fields.albinos') }}</th>
                    <th>{{ trans('cruds.patient.fields.created_at') }}</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td></td>
                    <td></td>
                    <td></td>
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.patients.index') }}",
    columns: [
{ data: 'name', name: 'name' },
{ data: 'solde', name: 'solde' },
{ data: 'phone', name: 'phone' },
{ data: 'albinos', name: 'albinos' },
{ data: 'created_at', name: 'created_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' , "searchable": false}
    ],
    orderCellsTop: true,
    order: [[ 4, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Patient').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value
      table
        .column($(this).parent().index())
        .search(value, strict)
        .draw()
  });
});

</script>
@endsection