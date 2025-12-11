<div class="card"><div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable-articleSaleDetails">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.medecin') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.appointment_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.saleDetail.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('global.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.title_singular') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($livraisonDetails as $key => $livraison)
                    <tr data-entry-id="{{ $livraison->id }}">
                        <td>
                            {{ $livraison->ordonnance->medecin->name ?? '' }}
                        </td>
                        <td>
                            {{ $livraison->ordonnance->patient->name  }}
                        </td>
                        <td>
                            {{ $livraison->ordonnance->consultation->created_at ?? ''  }}
                        </td>
                        <td>
                            {{ $livraison->quantity ?? '' }}
                        </td>
                        <td>
                            {{ $livraison->created_at ?? '' }}
                        </td>
                        <td>
                            {{ $livraison->user->name ?? '' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
