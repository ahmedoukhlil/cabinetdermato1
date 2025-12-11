@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.commandeDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CommandeDetail">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.commande') }}
                        </th>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.article') }}
                        </th>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.prix_unitaire') }}
                        </th>
                        <th>
                            {{ trans('cruds.commandeDetail.fields.montant_total') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandeDetails as $key => $commandeDetail)
                        <tr data-entry-id="{{ $commandeDetail->id }}">
                            <td>
                                {{ $commandeDetail->id ?? '' }}
                            </td>
                            <td>
                                {{ $commandeDetail->commande->reference ?? '' }}
                            </td>
                            <td>
                                {{ $commandeDetail->article->name ?? '' }}
                            </td>
                            <td>
                                {{ $commandeDetail->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $commandeDetail->prix_unitaire ?? '' }}
                            </td>
                            <td>
                                {{ $commandeDetail->montant_total ?? '' }}
                            </td>
                            <td></td>
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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-CommandeDetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection