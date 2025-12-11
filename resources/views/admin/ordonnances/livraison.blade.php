@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.ordonnances.livraison.store") }}" enctype="multipart/form-data">
            @csrf
            <input class="form-control" type="hidden" name="ordonnance_id" id="name" value="{{ old('ordonnance_id', $ordonnance->id) }}">

            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="form-group">
                        <h3>{{$ordonnance->patient->name}}  / {{$ordonnance->patient->contact}}  </h3>
                    </div>
                    <div class="form-group">
                        <h3>{{$ordonnance->medecin->full_name}}  / {{$ordonnance->medecin->contact}}  </h3>
                    </div>
                    <div class="form-group">
                        <h3>{{$ordonnance->reference}}  </h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="form-group">
                        <h2 style='text-align: center;' class='text-uppercase'>{{ trans('cruds.ordonnance.title_singular') }} </h2>
                    </div>
                    <table class=" table table-bordered table-striped table-hover datatable datatable-ordonnanceOrdonnanceDetails">
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.article.fields.category') }}</th>
                                <th>{{ trans('cruds.article.fields.forme') }}</th>
                                <th>{{ trans('cruds.ordonnanceDetail.fields.article') }}</th>
                                <th>{{ trans('cruds.ordonnanceDetail.fields.posologie') }}</th>
                                <th>{{ trans('cruds.ordonnanceDetail.fields.quantity') }}</th>
                                <th>{{ trans('cruds.ordonnanceDetail.fields.duration') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordonnance->ordonnanceOrdonnanceDetails as $key => $ordonnanceDetail)
                            <tr data-entry-id="{{ $ordonnanceDetail->id }}">
                                <td>{{ $ordonnanceDetail->article->category->name ?? '' }}</td>
                                <td>{{ $ordonnanceDetail->article->forme->name ?? '' }}</td>
                                <td>{{ $ordonnanceDetail->article->name ?? '' }}</td>
                                <td>{{ $ordonnanceDetail->posologie ?? '' }}</td>
                                <td>{{ $ordonnanceDetail->quantity ?? '' }}</td>
                                <td>{{ $ordonnanceDetail->duration ?? '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('cruds.article.fields.category')</th>
                        <th>@lang('cruds.article.fields.forme')</th>
                        <th>@lang('cruds.ordonnanceDetail.fields.article')</th>
                        <th>@lang('cruds.ordonnanceDetail.fields.quantity')</th>
                    </tr>
                </thead>
                <tbody id="livraison-detail">
                    @foreach($ordonnance->ordonnanceOrdonnanceDetails as $key => $ordonnanceDetail)
                    <tr data-entry-id="{{ $ordonnanceDetail->id }}">
                        <td>{{ $ordonnanceDetail->article->category->name ?? '' }}</td>
                        <td>{{ $ordonnanceDetail->article->forme->name ?? '' }}</td>
                        <td>
                            <input type ="hidden" value="{{$ordonnanceDetail->article_id}}" name="livraison[{{$key}}][article_id]" />
                            {{ $ordonnanceDetail->article->name ?? '' }}
                        </td>
                        <td>
                            {{($ordonnanceDetail->quantity > $ordonnanceDetail->article->quantity)? $ordonnanceDetail->article->quantity : $ordonnanceDetail->quantity}}
                            <input type ="hidden" value="{{($ordonnanceDetail->quantity > $ordonnanceDetail->article->quantity)? $ordonnanceDetail->article->quantity : $ordonnanceDetail->quantity}}" name="livraison[{{$key}}][quantity]" readonly/>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
