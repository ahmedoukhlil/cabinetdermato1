<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.commande.fields.reference') }}</th>
                        <th>{{ trans('cruds.commande.fields.montant_total') }}</th>
                        <th>{{ trans('cruds.commande.fields.montant_paye') }}</th>
                        <th>{{ trans('global.created_at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $key => $commande)
                    <tr data-entry-id="{{ $commande->id }}">
                        <td>{{ $commande->reference ?? '' }}</td>
                        <td>{{ number_format($commande->montant_total, 0, '', ' ') ?? '' }}</td>
                        <td>{{ number_format($commande->montant_paye, 0, '', ' ') ?? '' }}</td>
                        <td>{{ $commande->created_at ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>