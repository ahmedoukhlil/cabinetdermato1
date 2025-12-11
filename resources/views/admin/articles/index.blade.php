@extends('layouts.admin')
@section('content')
@can('article_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.articles.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.article.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.article.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Article">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.article.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.article.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.article.fields.forme') }}
                    </th>
                    <th>
                        {{ trans('cruds.article.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.article.fields.autorised_quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.article.fields.seuil') }}
                    </th>
                    <th>
                        {{ trans('cruds.article.fields.prix') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                @if($article->seuil >= $article->quantity)
                <tr class='table-danger'>
                    @else
                <tr>
                    @endif
                    <td>{{$article->category->name}}</td>
                    <td>{{$article->name}}</td>
                    <td>{{$article->forme->name}}</td>
                    <td>{{number_format($article->quantity, 0, '.', ' ')}}</td>
                    <td>{{number_format($article->autorised_quantity, 0, '.', ' ')}}</td>
                    <td>{{number_format($article->seuil, 0, '.', ' ')}}</td>
                    <td>{{number_format($article->prix, 0, '.', ' ')}}</td>
                    <td>
                        @can('article_show')
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.articles.show', $article->id) }}">
                            {{ trans('global.view') }}
                        </a>
                        @endcan

                        @can('article_edit')
                        <a class="btn btn-xs btn-info" href="{{ route('admin.articles.edit', $article->id) }}">
                            {{ trans('global.edit') }}
                        </a>
                        @endcan

                        @can('article_delete')
                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                        </form>
                        @endcan

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection