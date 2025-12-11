<div class="card"><div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable-articleCommandeDetails">
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
