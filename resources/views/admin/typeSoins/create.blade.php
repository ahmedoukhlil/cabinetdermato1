@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.type-soin.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.type-soins.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.type-soin.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.type-soin.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prix">{{ trans('cruds.type-soin.fields.prix') }}</label>
                <input class="form-control {{ $errors->has('prix') ? 'is-invalid' : '' }}" type="number" name="prix" id="prix" value="{{ old('prix', '') }}" step="0.01" required>
                @if($errors->has('prix'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prix') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.type-soin.fields.prix_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="caisse_id">{{ trans('cruds.type-soin.fields.caisse') }}</label>
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
                <span class="help-block">{{ trans('cruds.type-soin.fields.caisse_helper') }}</span>
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