
<div class="card">
    <div class="card-header">
        {{ trans('cruds.appointment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-patientAppointments">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.appointment_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.ordre') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.medecin') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.visite') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.consultation') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $key => $appointment)
                    <tr data-entry-id="{{ $appointment->id }}">
                        <td>
                            {{ $appointment->appointment_time ?? '' }}
                        </td>
                        <td>
                            {{ $appointment->ordre ?? '' }}
                        </td>
                        <td>
                            {{ $appointment->medecin->full_name ?? '' }}
                        </td>
                        <td>
                            {{ $appointment->visite->name ?? '' }}
                        </td>
                        <td>
                            {{ $appointment->consultation->name ?? '' }}
                        </td>
                        <td>
                            {{ $appointment->status->name ?? '' }}
                        </td>
                        <td>
                            @can('appointment_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.appointments.show', $appointment->id) }}">
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