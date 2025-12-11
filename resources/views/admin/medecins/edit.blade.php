@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.medecin.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.medecins.update", [$medecin->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="grade_id">{{ trans('cruds.medecin.fields.grade') }}</label>
                <select class="form-control select2 {{ $errors->has('grade') ? 'is-invalid' : '' }}" name="grade_id" id="grade_id" required>
                    @foreach($grades as $id => $grade)
                        <option value="{{ $id }}" {{ ($medecin->grade ? $medecin->grade->id : old('grade_id')) == $id ? 'selected' : '' }}>{{ $grade }}</option>
                    @endforeach
                </select>
                @if($errors->has('grade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('grade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medecin.fields.grade_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="specialite_id">{{ trans('cruds.medecin.fields.specialite') }}</label>
                <select class="form-control select2 {{ $errors->has('specialite') ? 'is-invalid' : '' }}" name="specialite_id" id="specialite_id" required>
                    @foreach($specialites as $id => $specialite)
                        <option value="{{ $id }}" {{ ($medecin->specialite ? $medecin->specialite->id : old('specialite_id')) == $id ? 'selected' : '' }}>{{ $specialite }}</option>
                    @endforeach
                </select>
                @if($errors->has('specialite'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialite') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medecin.fields.specialite_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.medecin.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $medecin->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medecin.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.medecin.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone" id="phone" value="{{ old('phone', $medecin->phone) }}" step="1">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medecin.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_2">{{ trans('cruds.medecin.fields.phone_2') }}</label>
                <input class="form-control {{ $errors->has('phone_2') ? 'is-invalid' : '' }}" type="number" name="phone_2" id="phone_2" value="{{ old('phone_2', $medecin->phone_2) }}" step="1">
                @if($errors->has('phone_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medecin.fields.phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.medecin.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $medecin->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medecin.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="free_days">{{ trans('cruds.medecin.fields.free_days') }}</label>
                <input class="form-control {{ $errors->has('free_days') ? 'is-invalid' : '' }}" type="number" name="free_days" id="free_days" value="{{ old('free_days', $medecin->free_days) }}" step="1" required>
                @if($errors->has('free_days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('free_days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medecin.fields.free_days_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="daily_consultation">{{ trans('cruds.medecin.fields.daily_consultation') }}</label>
                <input class="form-control {{ $errors->has('daily_consultation') ? 'is-invalid' : '' }}" type="number" name="daily_consultation" id="daily_consultation" value="{{ old('daily_consultation', $medecin->daily_consultation) }}" step="1">
                @if($errors->has('daily_consultation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('daily_consultation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medecin.fields.daily_consultation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="daily_rdv">{{ trans('cruds.medecin.fields.daily_rdv') }}</label>
                <input class="form-control {{ $errors->has('daily_rdv') ? 'is-invalid' : '' }}" type="number" name="daily_rdv" id="daily_rdv" value="{{ old('daily_rdv', $medecin->daily_rdv) }}" step="1">
                @if($errors->has('daily_rdv'))
                    <div class="invalid-feedback">
                        {{ $errors->first('daily_rdv') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medecin.fields.daily_rdv_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="consultation_duration">{{ trans('cruds.medecin.fields.consultation_duration') }}</label>
                <input class="form-control {{ $errors->has('consultation_duration') ? 'is-invalid' : '' }}" type="number" name="consultation_duration" id="consultation_duration" value="{{ old('consultation_duration', $medecin->consultation_duration) }}" step="1">
                @if($errors->has('consultation_duration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('consultation_duration') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medecin.fields.consultation_duration_helper') }}</span>
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