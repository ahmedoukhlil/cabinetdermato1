@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.commandePaiements.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Commande">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.commandePaiements.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.commandePaiements.fields.fournisseur') }}
                        </th>
                        <th>
                            {{ trans('cruds.commandePaiements.fields.montant') }}
                        </th>
                        <th>
                            {{ trans('global.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.commandePaiements.fields.user') }}
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
                                {{ $paiement->id ?? '' }}
                            </td>
                            <td>
                                {{ $paiement->fournisseur->name ?? '' }}
                            </td>
                            <td>
                                {{ $paiement->montant ?? '' }}
                            </td>
                            <td>
                                {{ $paiement->created_at ?? '' }}
                            </td>
                            <td>
                                {{ $paiement->user->name ?? '' }}
                            </td>
                            <td>
                                @can('commande_delete')
                                    <form action="{{ route('admin.commande-paiements.destroy', $paiement->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Commande:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection