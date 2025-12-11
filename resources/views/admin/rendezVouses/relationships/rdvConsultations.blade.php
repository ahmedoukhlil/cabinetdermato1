<div class="card">
    <div class="card-header">
        {{ trans('cruds.consultation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-rdvConsultations">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.consultation.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.consultation.fields.rdv') }}
                        </th>
                        <th>
                            {{ trans('cruds.consultation.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.consultation.fields.medecin') }}
                        </th>
                        <th>
                            {{ trans('cruds.medecin.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.consultation.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultations as $key => $consultation)
                        <tr data-entry-id="{{ $consultation->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $consultation->id ?? '' }}
                            </td>
                            <td>
                                {{ $consultation->rdv->date ?? '' }}
                            </td>
                            <td>
                                {{ $consultation->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $consultation->patient->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $consultation->medecin->name ?? '' }}
                            </td>
                            <td>
                                {{ $consultation->medecin->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $consultation->status->name ?? '' }}
                            </td>
                            <td>
                                @can('consultation_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.consultations.show', $consultation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('consultation_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.consultations.edit', $consultation->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('consultation_delete')
                                    <form action="{{ route('admin.consultations.destroy', $consultation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('consultation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.consultations.massDestroy') }}",
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
  let table = $('.datatable-rdvConsultations:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection