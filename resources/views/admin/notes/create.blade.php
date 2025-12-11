@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.note.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="patient_id">{{ trans('cruds.note.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id">
                    @foreach($patients as $id => $patient)
                        <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $patient }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.note.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objet">{{ trans('cruds.note.fields.objet') }}</label>
                <input class="form-control {{ $errors->has('objet') ? 'is-invalid' : '' }}" type="text" name="objet" id="objet" value="{{ old('objet', '') }}" required>
                @if($errors->has('objet'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objet') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.note.fields.objet_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="content">{{ trans('cruds.note.fields.content') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content">{!! old('content') !!}</textarea>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.note.fields.content_helper') }}</span>
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
