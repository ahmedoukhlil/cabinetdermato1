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
                <input type="hidden" name="patient_id" value="{{old('patient_id', $patient->id)}}" />
                <div class="form-group">
                    <h3>{{$patient->full_name}}  </h3>
                </div>
                <div class="form-group">
                    <h3>{{ trans('cruds.patient.fields.birth_day') }} : {{$patient->birth_day}} </h3>
                </div>
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
                <label for="montant" class="font-weight-bold">{{ trans('cruds.soin.fields.montant') }}</label>
                <input type="text" name="montant" value="{{old('montant', 0)}}" />
            </div>
            <a href="#" class="btn btn-xs btn-primary pull-right add-new">@lang('global.add')</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('cruds.soinDetail.fields.type')</th>
                        <th>@lang('cruds.soinDetail.fields.quantity')</th>
                        <th>@lang('cruds.soinDetail.fields.prix_unitaire')</th>
                        <th>@lang('cruds.soinDetail.fields.prix_total')</th>
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
    $(document).on('keyup', '.quatitySoin', function () {
        qtt = parseInt('0' + $(this).val());
        puI = $(this).attr('id').replace('quantity', 'prix_unitaire');
        pu = parseFloat('0' + $('#' + puI).val());
        ptI = $(this).attr('id').replace('quantity', 'prix_total');
        alert($(this).attr('id'));
    });

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


</script>
@stop
