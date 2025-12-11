@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.article.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.articles.update", [$article->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.article.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ ($article->category ? $article->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="forme_id">{{ trans('cruds.article.fields.forme') }}</label>
                <select class="form-control select2 {{ $errors->has('forme') ? 'is-invalid' : '' }}" name="forme_id" id="forme_id" required>
                    @foreach($formes as $id => $forme)
                        <option value="{{ $id }}" {{ ($article->forme ? $article->forme->id : old('forme_id')) == $id ? 'selected' : '' }}>{{ $forme }}</option>
                    @endforeach
                </select>
                @if($errors->has('forme'))
                    <div class="invalid-feedback">
                        {{ $errors->first('forme') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.forme_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.article.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $article->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.article.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $article->quantity) }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="autorised_quantity">{{ trans('cruds.article.fields.autorised_quantity') }}</label>
                <input class="form-control {{ $errors->has('autorised_quantity') ? 'is-invalid' : '' }}" type="number" name="autorised_quantity" id="autorised_quantity" value="{{ old('autorised_quantity', $article->autorised_quantity) }}" step="1">
                @if($errors->has('autorised_quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('autorised_quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.autorised_quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prix_aquisition">{{ trans('cruds.article.fields.prix_aquisition') }}</label>
                <input class="form-control {{ $errors->has('prix_aquisition') ? 'is-invalid' : '' }}" type="number" name="prix_aquisition" id="prix_aquisition" value="{{ old('prix_aquisition', $article->prix_aquisition) }}" step="1">
                @if($errors->has('prix_aquisition'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prix_aquisition') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.prix_aquisition_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prix">{{ trans('cruds.article.fields.prix') }}</label>
                <input class="form-control {{ $errors->has('prix') ? 'is-invalid' : '' }}" type="number" name="prix" id="prix" value="{{ old('prix', $article->prix) }}" step="1">
                @if($errors->has('prix'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prix') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.prix_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seuil">{{ trans('cruds.article.fields.seuil') }}</label>
                <input class="form-control {{ $errors->has('seuil') ? 'is-invalid' : '' }}" type="number" name="seuil" id="seuil" value="{{ old('seuil', $article->seuil) }}" step="1">
                @if($errors->has('seuil'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seuil') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.seuil_helper') }}</span>
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