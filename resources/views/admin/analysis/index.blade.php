@extends('layouts.admin')
@section('content')
@can('analysi_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.analysis.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.analysi.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.analysi.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Analysi">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.analysi.fields.reference') }}
                    </th>
                    <th>
                        {{ trans('cruds.analysi.fields.medecin') }}
                    </th>
                    <th>
                        {{ trans('cruds.analysi.fields.patient') }}
                    </th>
                    <th>
                        {{ trans('global.created_at') }}
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
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.analysis.index') }}",
    columns: [
{ data: 'reference', name: 'reference' },
{ data: 'medecin_name', name: 'medecin.name' },
{ data: 'patient_name', name: 'patient.name' },
{ data: 'created_at', name: 'created_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}', "searchable": false  }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Analysi').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection