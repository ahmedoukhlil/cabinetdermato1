@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.commandeDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.commande-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="commande_id">{{ trans('cruds.commandeDetail.fields.commande') }}</label>
                <select class="form-control select2 {{ $errors->has('commande') ? 'is-invalid' : '' }}" name="commande_id" id="commande_id" required>
                    @foreach($commandes as $id => $commande)
                        <option value="{{ $id }}" {{ old('commande_id') == $id ? 'selected' : '' }}>{{ $commande }}</option>
                    @endforeach
                </select>
                @if($errors->has('commande'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commande') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commandeDetail.fields.commande_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="article_id">{{ trans('cruds.commandeDetail.fields.article') }}</label>
                <select class="form-control select2 {{ $errors->has('article') ? 'is-invalid' : '' }}" name="article_id" id="article_id" required>
                    @foreach($articles as $id => $article)
                        <option value="{{ $id }}" {{ old('article_id') == $id ? 'selected' : '' }}>{{ $article }}</option>
                    @endforeach
                </select>
                @if($errors->has('article'))
                    <div class="invalid-feedback">
                        {{ $errors->first('article') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commandeDetail.fields.article_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.commandeDetail.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="1" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commandeDetail.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prix_unitaire">{{ trans('cruds.commandeDetail.fields.prix_unitaire') }}</label>
                <input class="form-control {{ $errors->has('prix_unitaire') ? 'is-invalid' : '' }}" type="number" name="prix_unitaire" id="prix_unitaire" value="{{ old('prix_unitaire', '') }}" step="1">
                @if($errors->has('prix_unitaire'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prix_unitaire') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commandeDetail.fields.prix_unitaire_helper') }}</span>
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