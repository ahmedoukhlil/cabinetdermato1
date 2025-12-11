@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.consultation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Consultation">
            <thead>
                <tr>
                    <th>{{ trans('cruds.consultation.fields.rdv') }}</th>
                    <th>{{ trans('cruds.consultation.fields.patient') }}</th>
                    <th>{{ trans('cruds.consultation.fields.medecin') }}</th>
                    <th>{{ trans('cruds.consultation.fields.status') }}</th>
                    <th>&nbsp;</th>
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
            @can('consultation_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
    let deleteButton = {
    text: deleteButtonTrans,
            url: "{{ route('admin.consultations.massDestroy') }}",
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
                    ajax: "{{ route('admin.consultations.index') }}",
                    columns: [
                    { data: 'appoitment', name: 'appoitment' },
                    { data: 'patient_name', name: 'patient.name' },
                    { data: 'medecin_name', name: 'medecin.name' },
                    { data: 'status_name', name: 'status.name' },
                    { data: 'actions', name: '{{ trans('global.actions') }}', "searchable": false }
                    ],
                    orderCellsTop: true,
                    order: [[ 1, 'desc' ]],
                    pageLength: 100,
            };
    let table = $('.datatable-Consultation').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
    $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    });

</script>
@endsection