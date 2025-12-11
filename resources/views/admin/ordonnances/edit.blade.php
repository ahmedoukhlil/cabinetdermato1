@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ordonnance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ordonnances.update", [$ordonnance->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <h3>Médecin : {{$ordonnance->medecin->name}}  </h3>
            </div>
            <div class="form-group">
                <h3>Patient : {{$ordonnance->patient->name}}  </h3>
            </div>
            <div class="form-group">
                <h3>{{$ordonnance->reference}}   --  {{$ordonnance->created_at}} </h3>
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
                        @forelse(old('ordonnance_details', []) as $index => $data)
                        @include('admin.ordonnances.ordonnanceLine', [
                        'index' => $index
                        ])
                        @empty
                        @foreach($ordonnance->ordonnanceOrdonnanceDetails as $item)
                        @include('admin.ordonnances.ordonnanceLine', [
                        'index' => 'id-' . $item->id,
                        'field' => $item
                        ])
                        @endforeach
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="ordonnance_comment">{{ trans('cruds.ordonnance.fields.ordonnance_comment') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('ordonnance_comment') ? 'is-invalid' : '' }}" name="ordonnance_comment" id="ordonnance_comment">{!! old('ordonnance_comment', $ordonnance->ordonnance_comment) !!}</textarea>
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
        </form>
    </div>
</div>



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

</script>
@endsection