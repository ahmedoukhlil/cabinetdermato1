@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.charge.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.charges.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="amount">{{ trans('cruds.charge.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.charge.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="dt_charge">{{ trans('cruds.charge.fields.dt_charge') }}</label>
                <input class="form-control date {{ $errors->has('dt_charge') ? 'is-invalid' : '' }}" type="text" name="dt_charge" id="dt_charge" value="{{ old('dt_charge', NOW()) }}" required>
                @if($errors->has('dt_charge'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dt_charge') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.charge.fields.dt_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.charge.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.charge.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="motif_id">{{ trans('cruds.charge.fields.motif') }}</label>
                <select class="form-control select2 {{ $errors->has('motif') ? 'is-invalid' : '' }}" name="motif_id" id="motif_id" required>
                    @foreach($motifs as $id => $entry)
                        <option value="{{ $id }}" {{ old('motif_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('motif'))
                    <div class="invalid-feedback">
                        {{ $errors->first('motif') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.charge.fields.motif_helper') }}</span>
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