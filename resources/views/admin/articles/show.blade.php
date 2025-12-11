@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.article.title_singular') }}
        @can('article_edit')
        <a class="btn btn-success pull-right" href="{{ route('admin.articles.edit', $article->id) }}">
            {{ trans('global.edit') }}
        </a>
        @endcan
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.articles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.article.fields.id') }}
                        </th>
                        <td>
                            {{ $article->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.article.fields.category') }}
                        </th>
                        <td>
                            {{ $article->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.article.fields.name') }}
                        </th>
                        <td>
                            {{ $article->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.article.fields.forme') }}
                        </th>
                        <td>
                            {{ $article->forme->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.article.fields.quantity') }}
                        </th>
                        <td>
                            {{ $article->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.article.fields.autorised_quantity') }}
                        </th>
                        <td>
                            {{ $article->autorised_quantity ?? '0' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.article.fields.prix_aquisition') }}
                        </th>
                        <td>
                            {{ $article->prix_aquisition }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.article.fields.prix') }}
                        </th>
                        <td>
                            {{ $article->prix }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.article.fields.user') }}
                        </th>
                        <td>
                            {{ $article->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.article.fields.seuil') }}
                        </th>
                        <td>
                            {{ $article->seuil }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#commande_details" role="tab" data-toggle="tab">
                {{ trans('cruds.commandeDetail.title') }}
            </a>
        </li>
        @if($article->livraisons->count())
        <li class="nav-item">
            <a class="nav-link" href="#livraison_details" role="tab" data-toggle="tab">
                {{ trans('global.livraison') }}
            </a>
        </li>
        @endif
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="commande_details">
            @includeIf('admin.articles.relationships.articleCommandeDetails', ['commandeDetails' => $article->articleCommandeDetails])
        </div>
        <div class="tab-pane" role="tabpanel" id="livraison_details">
            @includeIf('admin.articles.relationships.articleLivraisonDetails', ['livraisonDetails' => $article->livraisons])
        </div>
    </div>
</div>

@endsection