@extends('layouts.admin')
@section('content')
@can('forme_medicament_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.forme-medicaments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.formeMedicament.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.formeMedicament.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-FormeMedicament">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.formeMedicament.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.formeMedicament.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formeMedicaments as $key => $formeMedicament)
                        <tr data-entry-id="{{ $formeMedicament->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $formeMedicament->id ?? '' }}
                            </td>
                            <td>
                                {{ $formeMedicament->name ?? '' }}
                            </td>
                            <td>
                                @can('forme_medicament_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.forme-medicaments.show', $formeMedicament->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('forme_medicament_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.forme-medicaments.edit', $formeMedicament->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('forme_medicament_delete')
                                    <form action="{{ route('admin.forme-medicaments.destroy', $formeMedicament->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('forme_medicament_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.forme-medicaments.massDestroy') }}",
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
  let table = $('.datatable-FormeMedicament:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection