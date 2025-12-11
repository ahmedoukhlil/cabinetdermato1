<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('article_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }
    

    public function price(Article $article) {
        return $article->prix;
    }


    public function getList($category_id, $forme_id) {
        $articles = Article::where('category_id', $category_id)->where('forme_id', $forme_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return $articles;
    }

    public function create()
    {
        abort_if(Gate::denies('article_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $formes = \App\FormeMedicament::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.articles.create', compact('categories', 'formes'));
    }

    public function store(StoreArticleRequest $request)
    {
        $article = Article::create($request->all()+ ['user_id' => Auth::user()->id]);
        
        $article->load('category', 'forme', 'user', 'articleCommandeDetails');
        return view('admin.articles.show', compact('article'));

        return redirect()->route('admin.articles.index');
    }

    public function edit(Article $article)
    {
        abort_if(Gate::denies('article_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $formes = \App\FormeMedicament::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $article->load('category', 'user', 'forme');

        return view('admin.articles.edit', compact('categories', 'article', 'formes'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        return redirect()->route('admin.articles.index');
    }

    public function show(Article $article)
    {
        abort_if(Gate::denies('article_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $article->load('category', 'user', 'forme', 'articleCommandeDetails');

        return view('admin.articles.show', compact('article'));
    }

    public function destroy(Article $article)
    {
        abort_if(Gate::denies('article_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $article->delete();

        return back();
    }

    public function massDestroy(MassDestroyArticleRequest $request)
    {
        Article::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
