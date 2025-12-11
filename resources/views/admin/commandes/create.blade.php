@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.commande.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.commandes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="fournisseur_id">{{ trans('cruds.commande.fields.fournisseur') }}</label>
                <select class="form-control select2 {{ $errors->has('fournisseur') ? 'is-invalid' : '' }}" name="fournisseur_id" id="fournisseur_id" required>
                    @foreach($fournisseurs as $id => $fournisseur)
                    <option value="{{ $id }}" {{ old('fournisseur_id') == $id ? 'selected' : '' }}>{{ $fournisseur }}</option>
                    @endforeach
                </select>
                @if($errors->has('fournisseur'))
                <div class="invalid-feedback">
                    {{ $errors->first('fournisseur') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.commande.fields.fournisseur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference">{{ trans('cruds.commande.fields.reference') }}</label>
                <input class="form-control {{ $errors->has('reference') ? 'is-invalid' : '' }}" type="text" name="reference" id="reference" value="{{ old('reference', '') }}">
                @if($errors->has('reference'))
                <div class="invalid-feedback">
                    {{ $errors->first('reference') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.commande.fields.reference_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="montant_paye">{{ trans('cruds.commande.fields.montant_paye') }}</label>
                <input class="form-control {{ $errors->has('montant_paye') ? 'is-invalid' : '' }}" type="text" name="montant_paye" id="montant_paye" value="{{ old('montant_paye', 0) }}">
                @if($errors->has('montant_paye'))
                <div class="invalid-feedback">
                    {{ $errors->first('montant_paye') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.commande.fields.montant_paye_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="montant_total">{{ trans('cruds.commande.fields.montant_total') }}</label>
                <input class="form-control {{ $errors->has('montant_total') ? 'is-invalid' : '' }}" type="text" name="montant_total" id="montant_total" value="{{ old('montant_total', 0) }}" readonly>
                @if($errors->has('montant_total'))
                <div class="invalid-feedback">
                    {{ $errors->first('montant_total') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.commande.fields.montant_total_helper') }}</span>
            </div>
            <a href="#" class="btn btn-xs btn-primary pull-right add-new">@lang('global.add')</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('cruds.article.fields.category')</th>
                        <th>@lang('cruds.commandeDetail.fields.article')</th>
                        <th>@lang('cruds.commandeDetail.fields.quantity')</th>
                        <th>@lang('cruds.commandeDetail.fields.prix_unitaire')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="commande-detail">
                    @foreach(old('commande_details', []) as $index => $data)
                    @include('admin.commandes.commandeLine', [
                    'index' => $index
                    ])
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


@section('scripts')
@parent

<script type="text/html" id="commande-detail-template">
    @include('admin.commandes.commandeLine',
    [
    'index' => '_INDEX_',
    ])
</script > 

<script>
    $(document).on('click', '.add-new', function () {
        var tableBody = $("#commande-detail");
        var template = $('#commande-detail-template').html();
        var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
        if (isNaN(lastIndex)) {
            lastIndex = 0;
        }
        tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
        return false;
    });
    $(document).on('click', '.remove', function () {
        var row = $(this).parentsUntil('tr').parent();
        row.remove();
        return false;
    });

    var urlToArticles = "{{route('admin.categories.articles', [999999])}}";

    $(document).on('change', '.categorie_commande', function () {
        idFrom = $(this).attr('id');
        value = $(this).val();
        idTo = idFrom.replace('categorie_id', 'article_id');
        urlAr = urlToArticles.replace('999999', value);
        console.log(idFrom + ' => ' + idTo);
        selectFromOther(urlAr, idFrom, idTo);
    });

    $(document).on('keyup', '.commande_dets', function () {
        total = 0;
        $('.commande_qtt').each(function () {
            qtt = parseInt('0' + $(this).val().trim());
            prixElmt = $(this).attr('id').replace('quantity', 'prix_unitaire');
            prix = parseFloat('0'+$('#' + prixElmt).val());
            tot = prix * qtt;
            total += tot;
        });
        $('#montant_total').val(total);
    });

</script>
@stop
