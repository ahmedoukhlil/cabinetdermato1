@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.commande.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fournisseurs.save-paiement") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="hidden" name="fournisseur_id" value="{{old('fournisseur_id', $fournisseur->id)}}" />
                <div class="form-group">
                    <label for="montant">{{ trans('cruds.commandePaiements.fields.fournisseur') }}</label>
                    <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" type="text" name="fournisseur_name" id="fournisseur_name" value="{{ old('fournisseur_name', $fournisseur->name) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="montant">{{ trans('cruds.fournisseur.fields.solde') }}</label>
                    <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" type="text" name="fournisseur_solde" id="fournisseur_solde" value="{{ old('fournisseur_solde', $fournisseur->solde) }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="montant">{{ trans('cruds.commandePaiements.fields.montant') }}</label>
                <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" type="number" max='{{$fournisseur->solde}}' min='1' name="montant" id="montant" value="{{ old('montant', 1) }}">
                @if($errors->has('montant'))
                <div class="invalid-feedback">
                    {{ $errors->first('montant') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.commandePaiements.fields.montant_helper') }}</span>
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