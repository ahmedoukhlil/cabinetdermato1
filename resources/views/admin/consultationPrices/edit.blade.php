@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.consultationPrice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.consultation-prices.update", [$consultationPrice->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="type_id">{{ trans('cruds.consultationPrice.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id" required>
                    @foreach($types as $id => $type)
                        <option value="{{ $id }}" {{ ($consultationPrice->type ? $consultationPrice->type->id : old('type_id')) == $id ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.consultationPrice.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="medecin_id">{{ trans('cruds.consultationPrice.fields.medecin') }}</label>
                <select class="form-control select2 {{ $errors->has('medecin') ? 'is-invalid' : '' }}" name="medecin_id" id="medecin_id" required>
                    @foreach($medecins as $id => $medecin)
                        <option value="{{ $id }}" {{ ($consultationPrice->medecin ? $consultationPrice->medecin->id : old('medecin_id')) == $id ? 'selected' : '' }}>{{ $medecin }}</option>
                    @endforeach
                </select>
                @if($errors->has('medecin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('medecin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.consultationPrice.fields.medecin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tarif">{{ trans('cruds.consultationPrice.fields.tarif') }}</label>
                <input class="form-control {{ $errors->has('tarif') ? 'is-invalid' : '' }}" type="number" name="tarif" id="tarif" value="{{ old('tarif', $consultationPrice->tarif) }}" step="1" required>
                @if($errors->has('tarif'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tarif') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.consultationPrice.fields.tarif_helper') }}</span>
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