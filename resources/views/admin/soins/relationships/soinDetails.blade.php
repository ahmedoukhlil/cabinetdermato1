<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable-salesoinDetails">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.soinDetail.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.soinDetail.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.soinDetail.fields.prix_unitaire') }}
                        </th>
                        <th>
                            {{ trans('cruds.soinDetail.fields.montant') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($soinDetails as $key => $soinDetail)
                    <tr data-entry-id="{{ $soinDetail->id }}">
                        <td>
                            {{ $soinDetail->type->name ?? '' }}
                        </td>
                        <td>
                            {{ $soinDetail->quantity ?? '' }}
                        </td>
                        <td>
                            {{ $soinDetail->prix_unitaire ?? '' }}
                        </td>
                        <td>
                            {{ $soinDetail->montant ?? '' }}
                        </td>
                        <td></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>