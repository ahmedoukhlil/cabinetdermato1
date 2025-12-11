<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-rdvConsultations">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.ordre') }}
                        </th>
                        <th>
                            {{ trans('cruds.consultation.fields.rdv') }}
                        </th>
                        <th>
                            {{ trans('cruds.consultation.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultations as $key => $consultation)
                    <tr data-entry-id="{{ $consultation->id }}">
                        <td>
                            {{ $consultation->rdv->ordre ?? '' }}
                        </td>
                        <td>
                            {{ $consultation->rdv->appointment_time ?? '' }}
                        </td>
                        <td>
                            {{ $consultation->status->name ?? '' }}
                        </td>
                        <td>
                            @can('consultation_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.consultations.show', $consultation->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
