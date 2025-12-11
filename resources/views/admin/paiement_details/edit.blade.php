@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.paiementDetails.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.paiements.update", [$paiement->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="montant">{{ trans('cruds.paiementDetails.fields.montant') }}</label>
                <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" type="number" name="montant" id="montant" value="{{ old('montant', $paiement->montant) }}" step="1" required>
                @if($errors->has('montant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('montant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paiementDetails.fields.montant_helper') }}</span>
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