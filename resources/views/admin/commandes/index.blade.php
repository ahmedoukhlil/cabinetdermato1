@extends('layouts.admin')
@section('content')
@can('commande_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.commandes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.commande.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.commande.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Commande">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.commande.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.commande.fields.reference') }}
                        </th>
                        <th>
                            {{ trans('cruds.commande.fields.montant_total') }}
                        </th>
                        <th>
                            {{ trans('cruds.commande.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $key => $commande)
                        <tr data-entry-id="{{ $commande->id }}">
                            <td>
                                {{ $commande->id ?? '' }}
                            </td>
                            <td>
                                {{ $commande->reference ?? '' }}
                            </td>
                            <td>
                                {{ $commande->montant_total ?? '' }}
                            </td>
                            <td>
                                {{ $commande->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $commande->user->email ?? '' }}
                            </td>
                            <td>
                                @can('commande_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.commandes.show', $commande->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('commande_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.commandes.edit', $commande->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('commande_delete')
                                    <form action="{{ route('admin.commandes.destroy', $commande->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    order: [[ 1, 'desc' ]],
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