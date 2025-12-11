@extends('layouts.admin')
@section('content')
@can('medecin_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.medecins.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.medecin.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.medecin.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Medecin">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.medecin.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.medecin.fields.grade') }}
                    </th>
                    <th>
                        {{ trans('cruds.medecin.fields.specialite') }}
                    </th>
                    <th>
                        {{ trans('cruds.medecin.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.medecin.fields.free_days') }}
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
                    ajax: "{{ route('admin.medecins.index') }}",
                    columns: [
                    { data: 'placeholder', name: 'placeholder' },
                            { data: 'id', name: 'id' },
                            { data: 'grade_name', name: 'grade.name' },
                            { data: 'specialite_name', name: 'specialite.name' },
                            { data: 'name', name: 'name' },
                            { data: 'free_days', name: 'free_days' },
                            { data: 'actions', name: '{{ trans('global.actions') }}', "searchable": false  }
                    ],
                    orderCellsTop: true,
                    order: [[ 1, 'desc' ]],
                    pageLength: 100,
            };
    let table = $('.datatable-Medecin').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
    $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    });

</script>
@endsection