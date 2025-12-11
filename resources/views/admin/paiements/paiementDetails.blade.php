<div class="card">
    <div class="card-header">
        {{ trans('cruds.paiementDetails.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-facturePaiements">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.paiement.fields.id') }}</th>
                        <th>{{ trans('cruds.paiement.fields.facture') }}</th>
                        <th>{{ trans('cruds.paiement.fields.montant') }}</th>
                        <th>{{ trans('cruds.paiementDetails.fields.caisse') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $key => $paiement)
                    <tr data-entry-id="{{ $paiement->id }}">
                        <td>{{ $paiement->id ?? '' }}</td></td>
                        <td>{{ $paiement->facture->reference ?? '' }}</td>
                        <td>{{ number_format($paiement->montant, 0, '', ' ').' MRU' ?? '' }}</td>
                        <td>{{ $paiement->caisse->name ?? '' }}</td>
                        <td>
                            @can('paiement_delete')
                            <form action="{{ route('admin.paiements.delete.detail', $paiement->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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