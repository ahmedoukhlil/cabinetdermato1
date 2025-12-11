@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <span class="pull pull-right">
            <a class="btn btn-lg btn-success" href="{{ route('admin.ordonnances.print', $ordonnance->id) }}"> {{trans('global.print')}} </a>
            @if($ordonnance->articles_number == 0 && $ordonnance->created_at->format('Y-m-d') == NOW()->format('Y-m-d'))
            <a class="btn btn-lg btn-primary" href="{{ route('admin.ordonnances.livraison', $ordonnance->id) }}"> {{trans('global.livraison')}} </a>
            @endif
        </span>
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>{{ trans('cruds.ordonnance.fields.patient') }}</th>
                        <td>{{ $ordonnance->patient->full_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.ordonnance.fields.medecin') }}
                        </th>
                        <td>{{ $ordonnance->medecin->full_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.ordonnance.fields.reference') }}</th>
                        <td>{{ $ordonnance->reference }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.ordonnance.fields.ordonnance_comment') }}</th>
                        <td>{!! $ordonnance->ordonnance_comment !!}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.ordonnance.fields.consultation') }}</th>
                        <td>{{ $ordonnance->consultation->comment ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('global.created_at') }}</th>
                        <td>{{ $ordonnance->created_at ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ordonnances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="tab-content">
        @includeIf('admin.ordonnances.relationships.ordonnanceOrdonnanceDetails', ['ordonnanceDetails' => $ordonnance->ordonnanceOrdonnanceDetails])
        @if($ordonnance->livraison->count())
        <div class="card">
            <div class="card-body">
                <h2 align='center'>Livraison</h2>
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable-livraisonDetails">
                        <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.article.fields.category') }}
                                </th>
                                <th>
                                    {{ trans('cruds.saleDetail.fields.article') }}
                                </th>
                                <th>
                                    {{ trans('cruds.article.fields.forme') }}
                                </th>
                                <th>
                                    {{ trans('cruds.saleDetail.fields.quantity') }}
                                </th>
                                <th>
                                    {{ trans('global.created_at') }}
                                </th>
                                <th>
                                    {{ trans('cruds.user.title_singular') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordonnance->livraison as $key => $livraison)
                            <tr data-entry-id="{{ $livraison->id }}">
                                <td>
                                    {{ $livraison->article->category->name ?? '' }}
                                </td>
                                <td>
                                    {{ $livraison->article->name ?? '' }}
                                </td>
                                <td>
                                    {{ $livraison->article->forme->name ?? '' }}
                                </td>
                                <td>
                                    {{ $livraison->quantity ?? '0' }}
                                </td>
                                <td>
                                    {{ $livraison->created_at ?? '' }}
                                </td>
                                <td>
                                    {{ $livraison->user->name ?? '' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @endif
    </div>
</div>

@endsection