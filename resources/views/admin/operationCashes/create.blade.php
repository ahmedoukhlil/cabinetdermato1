@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.operationCash.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.operation-cashes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="caisse_id">{{ trans('cruds.operationCash.fields.caisse') }}</label>
                <select class="form-control select2 {{ $errors->has('caisse') ? 'is-invalid' : '' }}" name="caisse_id" id="caisse_id" required>
                    @foreach($caisses as $id => $caisse)
                        <option value="{{ $id }}" {{ old('caisse_id') == $id ? 'selected' : '' }}>{{ $caisse }}</option>
                    @endforeach
                </select>
                @if($errors->has('caisse'))
                    <div class="invalid-feedback">
                        {{ $errors->first('caisse') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.operationCash.fields.caisse_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="medecin_id">{{ trans('cruds.operationCash.fields.medecin') }}</label>
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
                <span class="help-block">{{ trans('cruds.operationCash.fields.medecin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="montant">{{ trans('cruds.operationCash.fields.montant') }}</label>
                <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" type="number" name="montant" id="montant" value="{{ old('montant', '') }}" step="0.01" required>
                @if($errors->has('montant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('montant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.operationCash.fields.montant_helper') }}</span>
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