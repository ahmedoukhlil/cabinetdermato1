@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.consultations.store") }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="patient_id" value="{{old('patient_id', $appointment->patient_id)}}" />
            <input type="hidden" name="appointment_id" value="{{old('appointment_id', $appointment->id)}}" />
            <div class="form-group">
                <h3>{{$appointment->patient->full_name}}  </h3>
            </div>
            <div class="form-group">
                <h3>{{ trans('cruds.patient.fields.birth_day') }} : {{$appointment->patient->birth_day}} </h3>
            </div>
            <div class="form-group">
                <h3>{{ trans('cruds.appointment.fields.appointment_time') }} : {{$appointment->appointment_time}} </h3>
            </div>
            <br/><br/>

            <div class="row">
                <div class="col-md-6">
                    <label for="motif" class="font-weight-bold">{{ trans('cruds.consultation.fields.motif') }}</label>
                    <textarea class="form-control {{ $errors->has('motif') ? 'is-invalid' : '' }}" name="motif" id="motif">{{ old('motif') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="diagnostic" class="font-weight-bold">{{ trans('cruds.consultation.fields.diagnostic') }}</label>
                    <textarea class="form-control {{ $errors->has('diagnostic') ? 'is-invalid' : '' }}" name="diagnostic" id="diagnostic">{{ old('diagnostic') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="hdm" class="font-weight-bold">{{ trans('cruds.consultation.fields.hdm') }}</label>
                    <textarea class="form-control {{ $errors->has('hdm') ? 'is-invalid' : '' }}" name="hdm" id="hdm">{{ old('hdm') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="atcd" class="font-weight-bold">{{ trans('cruds.consultation.fields.atcd') }}</label>
                    <textarea class="form-control {{ $errors->has('atcd') ? 'is-invalid' : '' }}" name="atcd" id="atcd">{{ old('atcd') }}</textarea>
                </div>
                <div class="col-md-8">
                    <label for="comment" class="font-weight-bold">{{ trans('cruds.consultation.fields.comment') }}</label>
                    <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment') }}</textarea>
                </div>
            </div>
            <br/>
            @include('admin.ordonnances.ordonnanceModal', ['formes'=>$formes])
            @include('admin.analysis.analyseModal')
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <div class="pull-right">
                    <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ordonnanceModal">
                        <i class="fa-fw far fa-edit"></i> 
                        {{ trans('cruds.ordonnance.title') }}
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#analyseModal">
                        <i class="fa-fw far fa-edit"></i> 
                        {{ trans('cruds.analysi.title') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@if($consultations->count())
<div class="card">
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#consultation_historique" role="tab" data-toggle="tab">
                Historique de consultations
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="consultation_historique">
            @includeIf('admin.consultations.relationships.history', ['consultations' => $consultations])
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
@parent

<script type="text/html" id="ordonnance-detail-template">
    @include('admin.ordonnances.ordonnanceLine',
    [
    'index' => '_INDEX_',
    ])
</script > 
<script type="text/html" id="analyse-detail-template">
    @include('admin.analysis.analyseLine',
    [
    'index' => '_INDEX_',
    ])
</script > 

<script>
    var routeArticlesList = "{{route('admin.articles.getList', [8888, 9999])}}";
    $(document).on('click', '.add-new', function () {
        nm = $(this).attr('name');
        var tableBody = $("#" + nm);
        var template = $('#' + nm + '-template').html();
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
    $(document).on('change', '.getArticleList', function () {
        var toId = $(this).attr('id').replace('category_id', 'article_id').
                replace('forme_id', 'article_id');
        categoryId = toId.replace('article_id', 'category_id');
        formeId = toId.replace('article_id', 'forme_id');
        category_id = $("#"+categoryId).val();
        forme_id = $("#"+formeId).val();
        
        url = routeArticlesList.replace('8888', category_id).replace('9999', forme_id);
        $('#'+toId).empty();
        if('' != category_id && '' != forme_id)
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $.each(data, function (key, value) {
                    $('#'+toId).append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    });
 
</script>
@stop
