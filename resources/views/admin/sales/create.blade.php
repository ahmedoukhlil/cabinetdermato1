@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sale.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sales.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.sale.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $patient)
                    <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $patient }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                <div class="invalid-feedback">
                    {{ $errors->first('patient') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.sale.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference">{{ trans('cruds.sale.fields.reference') }}</label>
                <input class="form-control {{ $errors->has('reference') ? 'is-invalid' : '' }}" type="text" name="reference" id="reference" value="{{ old('reference', '') }}">
                @if($errors->has('reference'))
                <div class="invalid-feedback">
                    {{ $errors->first('reference') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.sale.fields.reference_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="montant">{{ trans('cruds.sale.fields.montant') }}</label>
                <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" type="text" name="montant" id="montant" value="{{ old('montant', '0') }}" readonly>
                @if($errors->has('montant'))
                <div class="invalid-feedback">
                    {{ $errors->first('montant') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.sale.fields.montant_helper') }}</span>
            </div>
            <a href="#" class="btn btn-xs btn-primary pull-right add-new">@lang('global.add')</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('cruds.article.fields.category')</th>
                        <th>@lang('cruds.saleDetail.fields.article')</th>
                        <th>@lang('cruds.saleDetail.fields.quantity')</th>
                        <th>@lang('cruds.saleDetail.fields.prix_unitaire')</th>
                        <th>@lang('cruds.saleDetail.fields.montant_total')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="sale-detail">
                    @foreach(old('sale_details', []) as $index => $data)
                    @include('admin.sales.saleLine', [
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

<script type="text/html" id="sale-detail-template">
    @include('admin.sales.saleLine',
    [
    'index' => '_INDEX_',
    ])
</script > 

<script>
    $(document).on('click', '.add-new', function () {
        var tableBody = $("#sale-detail");
        var template = $('#sale-detail-template').html();
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

    $(document).on('change', '.categorie_sale', function () {
        idFrom = $(this).attr('id');
        value = $(this).val();
        idTo = idFrom.replace('categorie_id', 'article_id');
        urlAr = urlToArticles.replace('999999', value);
        selectFromOther(urlAr, idFrom, idTo);
    });

    var urlToPrice = "{{route('admin.articles.price', [999999])}}";

    $(document).on('change', '.artice_sale', function () {
        idFrom = $(this).attr('id');
        idTo = idFrom.replace('article_id', 'prix_unitaire');
        value = $(this).val();
        if ('' != value) {
            url = urlToPrice.replace('999999', value);
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $("#" + idTo).val(data);
                }
            });
        } else {
            $("#" + idTo).val('0');
        }
    });

    $(document).on('keyup', '.quantitySale', function () {
        total = 0;
        $('.quantitySale').each(function () {
            qtt = parseInt('0' + $(this).val().trim());
            prixElmt = $(this).attr('id').replace('quantity', 'prix_unitaire');
            prix = parseInt($('#' + prixElmt).val());
            tot = prix * qtt;
            totElmt = prixElmt.replace('prix_unitaire', 'montant_total');
            $('#' + totElmt).val(tot);
            total += tot;
        });
        $('#montant').val(total);
    });


</script>
@stop
