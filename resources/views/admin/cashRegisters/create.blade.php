@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cashRegister.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cash-registers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.cashRegister.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cashRegister.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="solde">{{ trans('cruds.cashRegister.fields.solde') }}</label>
                <input class="form-control {{ $errors->has('solde') ? 'is-invalid' : '' }}" type="number" name="solde" id="solde" value="{{ old('solde', '') }}" step="0.01">
                @if($errors->has('solde'))
                    <div class="invalid-feedback">
                        {{ $errors->first('solde') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cashRegister.fields.solde_helper') }}</span>
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