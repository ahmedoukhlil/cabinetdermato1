@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fournisseur.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fournisseurs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.fournisseur.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fournisseur.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.fournisseur.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone" id="phone" value="{{ old('phone', '') }}" step="1">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fournisseur.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="solde">{{ trans('cruds.fournisseur.fields.solde') }}</label>
                <input class="form-control {{ $errors->has('solde') ? 'is-invalid' : '' }}" type="number" name="solde" id="solde" value="{{ old('solde', '0') }}" step="1">
                @if($errors->has('solde'))
                    <div class="invalid-feedback">
                        {{ $errors->first('solde') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fournisseur.fields.solde_helper') }}</span>
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