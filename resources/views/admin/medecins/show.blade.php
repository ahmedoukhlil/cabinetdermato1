@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.medecin.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medecins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.id') }}
                        </th>
                        <td>
                            {{ $medecin->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.grade') }}
                        </th>
                        <td>
                            {{ $medecin->grade->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.specialite') }}
                        </th>
                        <td>
                            {{ $medecin->specialite->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.name') }}
                        </th>
                        <td>
                            {{ $medecin->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.phone') }}
                        </th>
                        <td>
                            {{ $medecin->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.phone_2') }}
                        </th>
                        <td>
                            {{ $medecin->phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.solde_soins') }}
                        </th>
                        <td>
                            {{ number_format($medecin->solde_soins, 0, '.', ' ') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.email') }}
                        </th>
                        <td>
                            {{ $medecin->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.free_days') }}
                        </th>
                        <td>
                            {{ $medecin->free_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.daily_consultation') }}
                        </th>
                        <td>
                            {{ $medecin->daily_consultation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.daily_rdv') }}
                        </th>
                        <td>
                            {{ $medecin->daily_rdv }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medecin.fields.consultation_duration') }}
                        </th>
                        <td>
                            {{ $medecin->consultation_duration }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medecins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#medecin_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#medecin_consultations" role="tab" data-toggle="tab">
                {{ trans('cruds.consultation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#medecin_ordonnances" role="tab" data-toggle="tab">
                {{ trans('cruds.ordonnance.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#medecin_analysis" role="tab" data-toggle="tab">
                {{ trans('cruds.analysi.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#medecin_consultation_prices" role="tab" data-toggle="tab">
                {{ trans('cruds.consultationPrice.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="medecin_consultation_prices">
            @includeIf('admin.medecins.relationships.medecinConsultationPrices', ['consultationPrices' => $medecin->medecinConsultationPrices])
        </div>
        <div class="tab-pane" role="tabpanel" id="medecin_ordonnances">
            @includeIf('admin.medecins.relationships.medecinOrdonnances', ['ordonnances' => $medecin->medecinOrdonnances])
        </div>
        <div class="tab-pane" role="tabpanel" id="medecin_consultations">
            @includeIf('admin.medecins.relationships.medecinConsultations', ['consultations' => $medecin->medecinConsultations])
        </div>
        <div class="tab-pane" role="tabpanel" id="medecin_analysis">
            @includeIf('admin.medecins.relationships.medecinAnalysis', ['analysis' => $medecin->medecinAnalysis])
        </div>
        <div class="tab-pane active" role="tabpanel" id="medecin_appointments">
            @includeIf('admin.medecins.relationships.medecinAppointments', ['appointments' => $medecin->medecinAppointments])
        </div>
    </div>
</div>

@endsection