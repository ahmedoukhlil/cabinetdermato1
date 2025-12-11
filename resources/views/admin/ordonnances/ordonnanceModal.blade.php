<!-- Modal -->
<div class="modal fade" id="ordonnanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Description de l'ordonnance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <a name = "ordonnance-detail" href="#" class="btn btn-xs btn-primary pull-right add-new">@lang('global.add')</a>
                @csrf
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('cruds.article.fields.category')</th>
                            <th>@lang('cruds.article.fields.forme')</th>
                            <th>@lang('cruds.ordonnanceDetail.fields.article')</th>
                            <th>@lang('cruds.ordonnanceDetail.fields.posologie')</th>
                            <th>@lang('cruds.ordonnanceDetail.fields.quantity')</th>
                            <th>@lang('cruds.ordonnanceDetail.fields.duration')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="ordonnance-detail">
                        @foreach(old('ordonnance_details', []) as $index => $data)
                        @include('admin.ordonnances.ordonnanceLine', [
                        'index' => $index
                        ])
                        @endforeach
                    </tbody>
                </table>
                <label for="ordonnance_comment" class="font-weight-bold">{{ trans('cruds.ordonnance.fields.comment') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('ordonnance_comment') ? 'is-invalid' : '' }}" name="ordonnance_comment" id="ordonnance_comment">{!! old('ordonnance_comment') !!}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
