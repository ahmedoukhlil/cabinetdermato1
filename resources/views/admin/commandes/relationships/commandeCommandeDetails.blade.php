<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable-commandeCommandeDetails">
                <thead>
                    <tr>
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
                            {{ $commandeDetail->article->name ?? '' }}
                        </td>
                        <td>
                            {{ number_format($commandeDetail->quantity, 0, '.', ' ') ?? '' }}
                        </td>
                        <td>
                            {{ number_format($commandeDetail->prix_unitaire, 0, '.', ' ') ?? '' }}
                        </td>
                        <td>
                            {{ number_format($commandeDetail->montant_total, 0, '.', ' ') ?? '' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>