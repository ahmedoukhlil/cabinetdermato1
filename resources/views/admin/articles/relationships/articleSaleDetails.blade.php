<div class="card"><div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable-articleSaleDetails">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.saleDetail.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.saleDetail.fields.sale') }}
                        </th>
                        <th>
                            {{ trans('cruds.saleDetail.fields.article') }}
                        </th>
                        <th>
                            {{ trans('cruds.saleDetail.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.saleDetail.fields.prix_unitaire') }}
                        </th>
                        <th>
                            {{ trans('cruds.saleDetail.fields.montant_total') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saleDetails as $key => $saleDetail)
                    <tr data-entry-id="{{ $saleDetail->id }}">
                        <td>
                            {{ $saleDetail->id ?? '' }}
                        </td>
                        <td>
                            {{ $saleDetail->sale->reference  }}
                        </td>
                        <td>
                            {{ $saleDetail->article->name ?? '' }}
                        </td>
                        <td>
                            {{ $saleDetail->quantity ?? '' }}
                        </td>
                        <td>
                            {{ $saleDetail->prix_unitaire ?? '' }}
                        </td>
                        <td>
                            {{ $saleDetail->montant_total ?? '' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
