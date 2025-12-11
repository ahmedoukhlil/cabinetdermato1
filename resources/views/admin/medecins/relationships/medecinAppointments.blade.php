<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-medecinAppointments">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.visite') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.consultation') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.appointment_time') }}
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
                                {{ $appointment->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->visite->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->consultation->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->appointment_time ?? '' }}
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

                                @can('appointment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.appointments.edit', $appointment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('appointment_delete')
                                    <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
