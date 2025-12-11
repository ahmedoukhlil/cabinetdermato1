@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.consultation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.consultations.update", [$consultation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.consultation.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $patient)
                        <option value="{{ $id }}" {{ ($consultation->patient ? $consultation->patient->id : old('patient_id')) == $id ? 'selected' : '' }}>{{ $patient }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.consultation.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="medecin_id">{{ trans('cruds.consultation.fields.medecin') }}</label>
                <select class="form-control select2 {{ $errors->has('medecin') ? 'is-invalid' : '' }}" name="medecin_id" id="medecin_id" required>
                    @foreach($medecins as $id => $medecin)
                        <option value="{{ $id }}" {{ ($consultation->medecin ? $consultation->medecin->id : old('medecin_id')) == $id ? 'selected' : '' }}>{{ $medecin }}</option>
                    @endforeach
                </select>
                @if($errors->has('medecin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('medecin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.consultation.fields.medecin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.consultation.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment', $consultation->comment) }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.consultation.fields.comment_helper') }}</span>
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