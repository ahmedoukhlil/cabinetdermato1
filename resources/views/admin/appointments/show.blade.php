@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            @if($appointment->status_id == 1)    <!-- confirmer le rendez vous !!-->
            <div class="form-group float-right">
                <a class="btn btn-success" href="{{ route('admin.appointments.confirm', $appointment->id) }}">
                    {{ trans('global.confirm') }}
                </a>
            </div>
            @endif
            @if(1 == Auth::user()->is_doctor && $appointment->status_id == 2  && Auth::user()->medecin_id == $appointment->medecin_id)    <!-- consulter le patient !!-->
            <div class="form-group float-right">
                <a class="btn btn-default" href="{{ route('admin.appointments.print', $appointment->id) }}">
                    <i class="fa fa-print" aria-hidden="true"></i>
                    {{ trans('global.print') }}
                </a>
                <a class="btn btn-success" href="{{ route('admin.consultations.create', $appointment->id) }}">
                    <i class="far fa-eye" aria-hidden="true"></i>
                    {{ trans('global.consult') }}
                </a>
            </div>
            @endif
            @if($appointment->status_id < 3 )
            <div class="form-group float-right">
                <a class="btn btn-info ml-1 mr-1" href="{{ route('admin.appointments.cancel', $appointment->id) }}">
                    <i class="fas fa-ban"></i>
                    {{ trans('global.cancel') }}
                </a>
            </div>
            <div class="form-group float-right">
                <a class="btn btn-danger" href="{{ route('admin.appointments.abandon', $appointment->id) }}">
                    <i class="far fa-trash-alt"></i>
                    {{ trans('global.abandon') }}
                </a>
            </div>
            @endif
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.id') }}
                        </th>
                        <td>
                            {{ $appointment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.patient') }}
                        </th>
                        <td>
                            {{ $appointment->patient->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.medecin') }}
                        </th>
                        <td>
                            {{ $appointment->medecin->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.ordre') }}
                        </th>
                        <td>
                            {{ $appointment->ordre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.visite') }}
                        </th>
                        <td>
                            {{ $appointment->visite->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.consultation') }}
                        </th>
                        <td>
                            {{ $appointment->consultation->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.appointment_time') }}
                        </th>
                        <td>
                            {{ $appointment->appointment_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.status') }}
                        </th>
                        <td>
                            {{ $appointment->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.gratuite') }}
                        </th>
                        <td>
                            {{ $appointment->gratuite ? trans('global.yes') : trans('global.no') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.user') }}
                        </th>
                        <td>
                            {{ $appointment->user->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.comment') }}
                        </th>
                        <td>
                            {{ $appointment->comment }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#rdv_consultations" role="tab" data-toggle="tab">
                {{ trans('cruds.consultation.title') }}
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link active" href="#consultation_factures" role="tab" data-toggle="tab">
                {{ trans('cruds.facture.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="rdv_consultations">
            @includeIf('admin.appointments.relationships.rdvConsultations', ['consultations' => $appointment->rdvConsultations])
        </div>
        <div class="tab-pane active" role="tabpanel" id="consultation_factures">
            @includeIf('admin.appointments.relationships.rdvFacture', ['factures' => $appointment->factures])
        </div>
    </div>
</div>

@endsection