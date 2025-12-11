<div class="card">
    <div class="card-header">
        {{ trans('cruds.paiement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-facturePaiements">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.paiement.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.paiement.fields.facture') }}
                        </th>
                        <th>
                            {{ trans('cruds.paiement.fields.reference') }}
                        </th>
                        <th>
                            {{ trans('cruds.paiement.fields.montant') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paiements as $key => $paiement)
                        <tr data-entry-id="{{ $paiement->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $paiement->id ?? '' }}
                            </td>
                            <td>
                                {{ $paiement->facture->montant ?? '' }}
                            </td>
                            <td>
                                {{ $paiement->reference ?? '' }}
                            </td>
                            <td>
                                {{ $paiement->montant ?? '' }}
                            </td>
                            <td>
                                @can('paiement_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.paiements.show', $paiement->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('paiement_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.paiements.edit', $paiement->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('paiement_delete')
                                    <form action="{{ route('admin.paiements.destroy', $paiement->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('paiement_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.paiements.massDestroy') }}",
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
  let table = $('.datatable-facturePaiements:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection