@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.patient.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.patients.update", [$patient->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-secondary font-weight-bold text-uppercase">
                            {{ trans('global.global_patient_information') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('cruds.patient.fields.name') }}</label>
                                <div class="form-inline">
                                    <select class="col-sm-2 {{ $errors->has('genre') ? 'is-invalid' : '' }}" name="genre_id" id="genre_id" required>
                                        @foreach($genres as $id => $genre)
                                        <option value="{{ $id }}" {{ ($patient->genre ? $patient->genre->id : old('genre_id')) == $id ? 'selected' : '' }}>{{ $genre }}</option>
                                        @endforeach
                                    </select>
                                    <input class="col-sm-10 {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" required>
                                    @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                </div>
                                <span class="help-block">{{ trans('cruds.patient.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="birth_day">{{ trans('cruds.patient.fields.birth_day') }}</label>
                                <input class="form-control date {{ $errors->has('birth_day') ? 'is-invalid' : '' }}" type="text" name="birth_day" id="birth_day" value="{{ old('birth_day', $patient->birth_day) }}" required>
                                @if($errors->has('birth_day'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('birth_day') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.patient.fields.birth_day_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id='albinos' name='albinos' style="margin-right: 10px;" @if($patient->albinos) {{"checked"}}@endif>
                                <label for="albinos">{{ trans('cruds.patient.fields.albinos') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-secondary font-weight-bold text-uppercase">
                            {{ trans('global.global_patient_contact') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="phone">{{ trans('cruds.patient.fields.phone') }}</label>
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone" id="phone" value="{{ old('phone', $patient->phone) }}" step="1">
                                @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.patient.fields.phone_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="phone_2">{{ trans('cruds.patient.fields.phone_2') }}</label>
                                <input class="form-control {{ $errors->has('phone_2') ? 'is-invalid' : '' }}" type="number" name="phone_2" id="phone_2" value="{{ old('phone_2', $patient->phone_2) }}" step="1">
                                @if($errors->has('phone_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone_2') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.patient.fields.phone_2_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="email">{{ trans('cruds.patient.fields.email') }}</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $patient->email) }}">
                                @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.patient.fields.email_helper') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="poids">{{ trans('cruds.patient.fields.poids') }}</label>
                <input class="form-control {{ $errors->has('poids') ? 'is-invalid' : '' }}" type="number" name="poids" id="poids" value="{{ old('poids', $patient->poids) }}" step="1">
                @if($errors->has('poids'))
                <div class="invalid-feedback">
                    {{ $errors->first('poids') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.poids_helper') }}</span>
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