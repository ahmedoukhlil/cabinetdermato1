@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.analyseDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.analyse-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="analyse_id">{{ trans('cruds.analyseDetail.fields.analyse') }}</label>
                <select class="form-control select2 {{ $errors->has('analyse') ? 'is-invalid' : '' }}" name="analyse_id" id="analyse_id" required>
                    @foreach($analyses as $id => $analyse)
                        <option value="{{ $id }}" {{ old('analyse_id') == $id ? 'selected' : '' }}>{{ $analyse }}</option>
                    @endforeach
                </select>
                @if($errors->has('analyse'))
                    <div class="invalid-feedback">
                        {{ $errors->first('analyse') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.analyseDetail.fields.analyse_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.analyseDetail.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.analyseDetail.fields.name_helper') }}</span>
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