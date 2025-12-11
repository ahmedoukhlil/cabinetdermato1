<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="col-lg-11 table table-bordered table-striped table-hover datatable-consultationFactures">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.facture.fields.id') }}</th>
                        <th>{{ trans('cruds.facture.fields.reference') }}</th>
                        <th>{{ trans('cruds.facture.fields.montant') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($factures as $key => $facture)
                    <tr data-entry-id="{{ $facture->id }}">
                        <td>{{ $facture->id ?? '' }}</td>
                        <td>{{ $facture->reference ?? '' }}</td>
                        <td>{{ $facture->montant ?? 0 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
