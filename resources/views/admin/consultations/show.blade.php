@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.consultation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.id') }}
                        </th>
                        <td>
                            {{ $consultation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.rdv') }}
                        </th>
                        <td>
                            {{ $consultation->rdv->appointment_time ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.patient') }}
                        </th>
                        <td>
                            {{ $consultation->patient->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.medecin') }}
                        </th>
                        <td>
                            {{ $consultation->medecin->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.user') }}
                        </th>
                        <td>
                            {{ $consultation->user->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.motif') }}
                        </th>
                        <td>
                            {{ $consultation->motif }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.diagnostic') }}
                        </th>
                        <td>
                            {{ $consultation->diagnostic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.hdm') }}
                        </th>
                        <td>
                            {{ $consultation->hdm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.atcd') }}
                        </th>
                        <td>
                            {{ $consultation->atcd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.comment') }}
                        </th>
                        <td>
                            {{ $consultation->comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.status') }}
                        </th>
                        <td>
                            {{ $consultation->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('global.created_at') }}
                        </th>
                        <td>
                            {{ $consultation->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.consultations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#consultation_ordonnances" role="tab" data-toggle="tab">
                {{ trans('cruds.ordonnance.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#consultation_analysis" role="tab" data-toggle="tab">
                {{ trans('cruds.analysi.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="consultation_ordonnances">
            @includeIf('admin.consultations.relationships.consultationOrdonnances', ['ordonnances' => $consultation->consultationOrdonnances])
        </div>
        <div class="tab-pane" role="tabpanel" id="consultation_analysis">
            @includeIf('admin.consultations.relationships.consultationAnalysis', ['analysis' => $consultation->consultationAnalysis])
        </div>
    </div>
</div>

@endsection