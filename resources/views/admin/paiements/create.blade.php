@extends('layouts.admin')
@section('content')
<form method="POST" action="{{ route("admin.paiements.store") }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.paiement.title_singular') }}
        </div>

        <div class="card-body">

            <input type="hidden" name="patient_id" value="{{old('patient_id', $patient->id)}}" />
            <div class="form-group">
                <h3>{{$patient->full_name}}  </h3>
            </div>
            <div class="form-group">
                <h3>{{ trans('cruds.patient.fields.solde') }} : {{$patient->solde}} </h3>
            </div>
            <br/>
            <div class="form-group">
                <label class="required font-weight-bold" for="montant">{{ trans('cruds.paiement.fields.montant') }}</label>
                <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" type="number" name="montant" id="montant" value="{{ old('montant', '') }}" step="1" required readonly>
                @if($errors->has('montant'))
                <div class="invalid-feedback">
                    {{ $errors->first('montant') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paiement.fields.montant_helper') }}</span>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.paiementDetails.title_singular') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('cruds.paiementDetails.fields.facture')</th>
                        <th>@lang('cruds.paiementDetails.fields.montant')</th>
                        <th>@lang('cruds.paiementDetails.fields.restant')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="paiement-detail">
                    @forelse(old('paiement_details', []) as $index => $data)
                        @include('admin.paiement_details.create', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($patient->facturesDues as $item)
                            @include('admin.paiement_details.create', [
                                'index' => $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <label for="comment" class="font-weight-bold">{{ trans('cruds.paiement.fields.comment') }}</label>
            <textarea class="form-control ckeditor {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{!! old('comment') !!}</textarea>
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</form>


@endsection


@section('scripts')
@parent

<script>
    $(document).on('change', '.mnt_encaissement', function () {
        montant = 0;
        $('.mnt_encaissement').each(function () {
            mnt = parseInt($(this).val());
            montant += mnt;
        });
        $('#montant').val(montant);
    });
    $(document).on('click', '.remove', function () {
        var row = $(this).parentsUntil('tr').parent();
        row.remove();
        return false;
    });

</script>
@stop
