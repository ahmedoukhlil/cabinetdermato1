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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-analyseAnalysis">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.analysi.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.analysi.fields.analyse') }}
                        </th>
                        <th>
                            {{ trans('cruds.analysi.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.analysi.fields.medecin') }}
                        </th>
                        <th>
                            {{ trans('cruds.medecin.fields.last_name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($analysis as $key => $analysi)
                        <tr data-entry-id="{{ $analysi->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $analysi->id ?? '' }}
                            </td>
                            <td>
                                {{ $analysi->analyse->name ?? '' }}
                            </td>
                            <td>
                                {{ $analysi->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $analysi->patient->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $analysi->medecin->name ?? '' }}
                            </td>
                            <td>
                                {{ $analysi->medecin->last_name ?? '' }}
                            </td>
                            <td>
                                @can('analysi_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.analysis.show', $analysi->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('analysi_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.analysis.edit', $analysi->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('analysi_delete')
                                    <form action="{{ route('admin.analysis.destroy', $analysi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('analysi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.analysis.massDestroy') }}",
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
  let table = $('.datatable-analyseAnalysis:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection