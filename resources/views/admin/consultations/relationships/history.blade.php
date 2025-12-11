<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="col-lg-11 table table-bordered table-striped table-hover datatable datatable-consultationHistories">
            <thead>
                <tr>
                    <th>{{ trans('cruds.consultation.fields.rdv') }}</th>
                    <th>{{ trans('cruds.consultation.fields.patient') }}</th>
                    <th>{{ trans('cruds.consultation.fields.medecin') }}</th>
                    <th>{{ trans('cruds.consultation.fields.status') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
                <tbody>
                    @foreach($consultations as $key => $consultation)
                    <tr data-entry-id="{{ $consultation->id }}">
                        <td>{{ $consultation->rdv->appointment_time ?? '' }}</td>
                        <td>{{ $consultation->patient->full_name ?? '' }}</td>
                        <td>{{ $consultation->medecin->full_name ?? '' }}</td>
                        <td>{{ $consultation->status->name ?? '' }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.consultations.show', $consultation->id) }}">
                                {{ trans('global.view') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
