@extends('layouts.admin')
@section('content')

<form method="POST" action="{{ route("admin.ordonnances.store") }}" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.ordonnance.title_singular') }}
        </div>

        <div class="card-body">
            @csrf
            <div class="form-group">
                <label for="patient_id">{{ trans('cruds.ordonnance.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id">
                    @foreach($patients as $id => $patient)
                    <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $patient }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                <div class="invalid-feedback">
                    {{ $errors->first('patient') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.ordonnance.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <a name = "ordonnance-detail" href="#" class="btn btn-xs btn-primary pull-right add-new">@lang('global.add')</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('cruds.ordonnanceDetail.fields.medicament')</th>
                            <th>@lang('cruds.ordonnanceDetail.fields.forme')</th>
                            <th>@lang('cruds.ordonnanceDetail.fields.posologie')</th>
                            <th>@lang('cruds.ordonnanceDetail.fields.quantity')</th>
                            <th>@lang('cruds.ordonnanceDetail.fields.duration')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="ordonnance-detail">
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="ordonnance_comment">{{ trans('cruds.ordonnance.fields.ordonnance_comment') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('ordonnance_comment') ? 'is-invalid' : '' }}" name="ordonnance_comment" id="ordonnance_comment">{!! old('ordonnance_comment') !!}</textarea>
                @if($errors->has('ordonnance_comment'))
                <div class="invalid-feedback">
                    {{ $errors->first('ordonnance_comment') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.ordonnance.fields.ordonnance_comment_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
    </div>

</form>


@endsection

@section('scripts')
<script type="text/html" id="ordonnance-detail-template">
    @include('admin.ordonnances.ordonnanceLine',
    [
    'index' => '_INDEX_',
    ])
</script > 

<script>
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
    $(document).ready(function () {
        $('.add-new').click();
    });

</script>
@endsection