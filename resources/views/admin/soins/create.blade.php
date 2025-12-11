@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.soin.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.soins.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.soin.fields.patient') }}</label>
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
                <span class="help-block">{{ trans('cruds.soin.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="medecin_id">{{ trans('cruds.soin.fields.medecin') }}</label>
                <select class="form-control select2 {{ $errors->has('medecin') ? 'is-invalid' : '' }}" name="medecin_id" id="medecin_id" required>
                    @foreach($medecins as $id => $medecin)
                    <option value="{{ $id }}" {{ old('medecin_id') == $id ? 'selected' : '' }}>{{ $medecin }}</option>
                    @endforeach
                </select>
                @if($errors->has('medecin'))
                <div class="invalid-feedback">
                    {{ $errors->first('medecin') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.soin.fields.medecin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="montant">{{ trans('cruds.soin.fields.montant') }}</label>
                <input class="form-control" type="number" name="montant" id = "montant" value="{{old('montant', 0)}}" disabled/>
            </div>
            <a href="#" class="btn btn-xs btn-primary pull-right add-new">@lang('global.add')</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('cruds.soinDetail.fields.type')</th>
                        <th>@lang('cruds.soinDetail.fields.quantity')</th>
                        <th>@lang('cruds.soinDetail.fields.prix_unitaire')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="soin-detail">
                    @foreach(old('soin_details', []) as $index => $data)
                    @include('admin.soins.soinLine', [
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

<script type="text/html" id="soin-detail-template">
    @include('admin.soins.soinLine',
    [
    'index' => '_INDEX_',
    ])
</script > 

<script>
    $(document).on('click', '.add-new', function () {
        var tableBody = $("#soin-detail");
        var template = $('#soin-detail-template').html();
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


    var urlToPrice = "{{route('admin.type-soins.price', [999999])}}";

    $(document).on('change', '.type_soin', function () {
        idFrom = $(this).attr('id');
        idTo = idFrom.replace('type_id', 'prix_unitaire');
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

    $(document).on('keyup', '.quatitySoin', function () {
        tot_g = 0;
        $('.quatitySoin').each(function () {
            priceElmt = $(this).attr('id').replace('quantity', 'prix_unitaire');
            totalElmt = $(this).attr('id').replace('quantity', 'prix_total');
            price = '0' + $('#' + $.escapeSelector(priceElmt)).val().trim();
            total = parseInt('0' + $(this).val().trim()) * parseFloat(price);
            $('#' + $.escapeSelector(totalElmt)).val(total);
            tot_g += total;
        });
        $('#montant').val(tot_g);
    });

</script>
@stop
