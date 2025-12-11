@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointments.store") }}" enctype="multipart/form-data">
            @csrf
            <input class="form-control" type="hidden" name="patient_id" id="name" value="{{ old('patient_id', $patient->id) }}">

            <div class="form-group">
                <h3>{{$patient->name}}  / {{$patient->contact}}  </h3>
            </div>
            <div class="form-group">
                <label class="required" for="medecin_id">{{ trans('cruds.appointment.fields.medecin') }}</label>
                <select class="form-control select2 {{ $errors->has('medecin') ? 'is-invalid' : '' }}" name="medecin_id" id="medecin_id" required>
                    @foreach($medecins as $id => $medecin)
                    <option value="{{ $id }}" {{ old('medecin_id') == $id ? 'selected' : '' }}>{{ $medecin }}</option>
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
                    <option value="{{ $id }}" {{ old('visite_id') == $id ? 'selected' : '' }}>{{ $visite }}</option>
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
                    <option value="{{ $id }}" {{ old('consultation_id') == $id ? 'selected' : '' }}>{{ $consultation }}</option>
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
                <input class="form-control datetime {{ $errors->has('appointment_time') ? 'is-invalid' : '' }}" type="text" name="appointment_time" id="appointment_time" value="{{ old('appointment_time') }}">
                @if($errors->has('appointment_time'))
                <div class="invalid-feedback">
                    {{ $errors->first('appointment_time') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.appointment_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.appointment.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment') }}</textarea>
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