@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paiement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>{{ trans('cruds.paiement.fields.id') }}</th><td>{{ $paiement->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.paiement.fields.reference') }}</th><td>{{ $paiement->reference }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.paiement.fields.montant') }}</th><td>{{ number_format($paiement->montant, 0, '', ' ') }} MRU</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.paiement.fields.user') }}</th><td>{{ $paiement->user->full_name ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.paiements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@include('admin.paiements.paiementDetails', ['details' => $paiement->details]);
@endsection