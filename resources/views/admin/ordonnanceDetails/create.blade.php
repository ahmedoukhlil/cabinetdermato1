@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.ordonnanceDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ordonnance-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="medicament">{{ trans('cruds.ordonnanceDetail.fields.medicament') }}</label>
                <input class="form-control {{ $errors->has('medicament') ? 'is-invalid' : '' }}" type="text" name="medicament" id="medicament" value="{{ old('medicament', '') }}" required>
                @if($errors->has('medicament'))
                    <div class="invalid-feedback">
                        {{ $errors->first('medicament') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ordonnanceDetail.fields.medicament_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="forme_id">{{ trans('cruds.ordonnanceDetail.fields.forme') }}</label>
                <select class="form-control select2 {{ $errors->has('forme') ? 'is-invalid' : '' }}" name="forme_id" id="forme_id">
                    @foreach($formes as $id => $forme)
                        <option value="{{ $id }}" {{ old('forme_id') == $id ? 'selected' : '' }}>{{ $forme }}</option>
                    @endforeach
                </select>
                @if($errors->has('forme'))
                    <div class="invalid-feedback">
                        {{ $errors->first('forme') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ordonnanceDetail.fields.forme_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="posologie">{{ trans('cruds.ordonnanceDetail.fields.posologie') }}</label>
                <input class="form-control {{ $errors->has('posologie') ? 'is-invalid' : '' }}" type="text" name="posologie" id="posologie" value="{{ old('posologie', '') }}" required>
                @if($errors->has('posologie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('posologie') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ordonnanceDetail.fields.posologie_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.ordonnanceDetail.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '1') }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ordonnanceDetail.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="duration">{{ trans('cruds.ordonnanceDetail.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration" id="duration" value="{{ old('duration', '') }}" step="1">
                @if($errors->has('duration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('duration') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ordonnanceDetail.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ordonnance_id">{{ trans('cruds.ordonnanceDetail.fields.ordonnance') }}</label>
                <select class="form-control select2 {{ $errors->has('ordonnance') ? 'is-invalid' : '' }}" name="ordonnance_id" id="ordonnance_id" required>
                    @foreach($ordonnances as $id => $ordonnance)
                        <option value="{{ $id }}" {{ old('ordonnance_id') == $id ? 'selected' : '' }}>{{ $ordonnance }}</option>
                    @endforeach
                </select>
                @if($errors->has('ordonnance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ordonnance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ordonnanceDetail.fields.ordonnance_helper') }}</span>
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