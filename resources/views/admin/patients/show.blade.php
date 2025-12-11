@extends('layouts.admin')
@section('content')
@can('appointment_create')
<div style="margin-top: -15px;" class="row">
    <div class="col-lg-12">
        <div class="pull pull-right">
        <a class="btn btn-success" href="{{ route('admin.appointments.create', $patient->id) }}">
            {{ trans('cruds.appointment.title_singular') }}
        </a>
            
        <a class="btn btn-primary" href="{{ route('admin.soins.create-wp', $patient->id) }}">
            {{ trans('cruds.soin.title_singular') }}
        </a>
        </div>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.patient.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                        <td>
                            {{ $patient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.genre') }}
                        </th>
                        <td>
                            {{ $patient->genre->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.name') }}
                        </th>
                        <td>
                            {{ $patient->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.albinos') }}
                        </th>
                        <td>
                            {{ ($patient->albinos) ? 'Albions' :' ' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.phone') }}
                        </th>
                        <td>
                            {{ $patient->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.phone_2') }}
                        </th>
                        <td>
                            {{ $patient->phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.birth_day') }}
                        </th>
                        <td>
                            {{ $patient->birth_day }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.email') }}
                        </th>
                        <td>
                            {{ $patient->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.poids') }}
                        </th>
                        <td>
                            {{ $patient->poids }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#patient_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        @can('consultation_show')
        <li class="nav-item">
            <a class="nav-link" href="#patient_consultations" role="tab" data-toggle="tab">
                {{ trans('cruds.consultation.title') }}
            </a>
        </li>
        @endcan
        <li class="nav-item">
            <a class="nav-link" href="#patient_ordonnances" role="tab" data-toggle="tab">
                {{ trans('cruds.ordonnance.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_analysis" role="tab" data-toggle="tab">
                {{ trans('cruds.analysi.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_notes" role="tab" data-toggle="tab">
                {{ trans('cruds.note.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="patient_ordonnances">
            @includeIf('admin.patients.relationships.patientOrdonnances', ['ordonnances' => $patient->patientOrdonnances])
        </div>
        @can('consultation_show')
        <div class="tab-pane" role="tabpanel" id="patient_consultations">
            @includeIf('admin.patients.relationships.patientConsultations', ['consultations' => $patient->patientConsultations])
        </div>
        @endcan
        <div class="tab-pane" role="tabpanel" id="patient_analysis">
            @includeIf('admin.patients.relationships.patientAnalysis', ['analysis' => $patient->patientAnalysis])
        </div>
        <div class="tab-pane active" role="tabpanel" id="patient_appointments">
            @includeIf('admin.patients.relationships.patientAppointments', ['appointments' => $patient->patientAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="patient_notes">
            @includeIf('admin.patients.relationships.patientNotes', ['notes' => $patient->notes])
        </div>
    </div>
</div>

@endsection