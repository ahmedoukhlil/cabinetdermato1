<!-- Modal -->
<div class="modal fade" id="analyseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Description de l'analyse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a name = "analyse-detail" href="#" class="btn btn-xs btn-primary pull-right add-new">@lang('global.add')</a>
                @csrf
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('cruds.analyseDetail.fields.name')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="analyse-detail">
                        @foreach(old('analyse_details', []) as $index => $data)
                        @include('admin.analysis.analyseLine', [
                        'index' => $index
                        ])
                        @endforeach
                    </tbody>
                </table>
                <label for="analysis_comment" class="font-weight-bold">{{ trans('cruds.analysi.fields.analysis_comment') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('analysis_comment') ? 'is-invalid' : '' }}" name="analysis_comment" id="analysis_comment">{!! old('analysis_comment') !!}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
