<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.commandePaiements.fields.montant') }}</th>
                        <th>{{ trans('cruds.commandePaiements.fields.user') }}</th>
                        <th>{{ trans('global.created_at') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandePaiements as $key => $commandePaiement)
                    <tr data-entry-id="{{ $commandePaiement->id }}">
                        <td>{{ number_format($commandePaiement->montant, 0, '', ' ') ?? 0 }}</td>
                        <td>{{ $commandePaiement->user->name ?? '' }}</td>
                        <td>{{ $commandePaiement->created_at ?? '' }}</td>
                        <td>
                            @can('commande_paiement_delete')
                            <form action="{{ route('admin.commande-paiements.destroy', $commandePaiement->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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