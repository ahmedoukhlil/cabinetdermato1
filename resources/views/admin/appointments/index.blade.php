@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointments.filter") }}" enctype="multipart/form-data">
            @csrf
            <div class="offset-md-3 col-md-8">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white h4">
                        Randez-Vous filtre
                    </div>
                    <div class="card-body text-info">
                        <div class="row">
                            <div class="col">
                                <label class="font-weight-bold" for="appointment_date">{{ trans('global.filterDate') }}</label> : 
                                <input type="text" value="{{$appointment_date}}" class="date datepicker" name="appointment_date" id="appointment_date"/>
                            </div>
                            <div class="col">
                                <label class="font-weight-bold" for="status_id">{{ trans('cruds.appointment.fields.status') }}</label> : 
                                <select name="status_id" id="status_id">
                                    @foreach($status as $id => $lib)
                                    <option value="{{ $id }}" {{ $status_id == $id ? 'selected' : '' }}>{{ $lib }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-info pull-left" type="submit">
                                    {{ trans('global.validate') }}
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Appointment">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.appointment.fields.patient') }}</th>
                        <th>{{ trans('cruds.appointment.fields.medecin') }}</th>
                        <th>{{ trans('cruds.appointment.fields.ordre') }}</th>
                        <th>{{ trans('cruds.appointment.fields.visite') }}</th>
                        <th>{{ trans('cruds.appointment.fields.consultation') }}</th>
                        <th>{{ trans('cruds.appointment.fields.appointment_time') }}</th>
                        <th>{{ trans('cruds.appointment.fields.status') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $key => $appointment)
                    <tr data-entry-id="{{ $appointment->id }}">
                        <td>{{ $appointment->patient->full_name ?? '' }}</td>
                        <td>{{ $appointment->medecin->name ?? '' }}</td>
                        <td>{{ $appointment->ordre ?? '' }}</td>
                        <td>{{ $appointment->visite->name ?? '' }}</td>
                        <td>{{ $appointment->consultation->name ?? '' }}</td>
                        <td>{{ $appointment->appointment_time ?? '' }}</td>
                        <td>{{ $appointment->status->name ?? '' }}</td>
                        <td>

                            @if(1 == Auth::user()->is_doctor && $appointment->status_id == 2 && Auth::user()->medecin_id == $appointment->medecin_id)
                            <a class="btn btn-xs btn-success" href="{{ route('admin.consultations.create', $appointment->id) }}">
                                <i class="far fa-eye" aria-hidden="true"></i>
                                {{ trans('global.consult') }}
                            </a>
                            @endif

                            @can('appointment_show')

                            @if($appointment->status_id == 1)    <!-- confirmer le rendez vous !!-->
                            <a class="btn btn-xs btn-success" href="{{ route('admin.appointments.confirm', $appointment->id) }}">
                                {{ trans('global.confirm') }}
                            </a>
                            @endif

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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
                    order: [[ 1, 'desc' ]],
                    pageLength: 100,
            });
    let table = $('.datatable-Appointment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
    $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    })

</script>
@endsection