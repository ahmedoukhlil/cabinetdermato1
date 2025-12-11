@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointments.update", [$appointment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.appointment.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $patient)
                        <option value="{{ $id }}" {{ ($appointment->patient ? $appointment->patient->id : old('patient_id')) == $id ? 'selected' : '' }}>{{ $patient }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="medecin_id">{{ trans('cruds.appointment.fields.medecin') }}</label>
                <select class="form-control select2 {{ $errors->has('medecin') ? 'is-invalid' : '' }}" name="medecin_id" id="medecin_id" required>
                    @foreach($medecins as $id => $medecin)
                        <option value="{{ $id }}" {{ ($appointment->medecin ? $appointment->medecin->id : old('medecin_id')) == $id ? 'selected' : '' }}>{{ $medecin }}</option>
                    @endforeach
                </select>
                @if($errors->has('medecin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('medecin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.medecin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="visite_id">{{ trans('cruds.appointment.fields.visite') }}</label>
                <select class="form-control select2 {{ $errors->has('visite') ? 'is-invalid' : '' }}" name="visite_id" id="visite_id" required>
                    @foreach($visites as $id => $visite)
                        <option value="{{ $id }}" {{ ($appointment->visite ? $appointment->visite->id : old('visite_id')) == $id ? 'selected' : '' }}>{{ $visite }}</option>
                    @endforeach
                </select>
                @if($errors->has('visite'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visite') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.visite_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="consultation_id">{{ trans('cruds.appointment.fields.consultation') }}</label>
                <select class="form-control select2 {{ $errors->has('consultation') ? 'is-invalid' : '' }}" name="consultation_id" id="consultation_id">
                    @foreach($consultations as $id => $consultation)
                        <option value="{{ $id }}" {{ ($appointment->consultation ? $appointment->consultation->id : old('consultation_id')) == $id ? 'selected' : '' }}>{{ $consultation }}</option>
                    @endforeach
                </select>
                @if($errors->has('consultation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('consultation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.consultation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="appointment_time">{{ trans('cruds.appointment.fields.appointment_time') }}</label>
                <input class="form-control datetime {{ $errors->has('appointment_time') ? 'is-invalid' : '' }}" type="text" name="appointment_time" id="appointment_time" value="{{ old('appointment_time', $appointment->appointment_time) }}" required>
                @if($errors->has('appointment_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.appointment_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.appointment.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment', $appointment->comment) }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection