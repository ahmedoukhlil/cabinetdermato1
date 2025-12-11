<div class="card">
    <div class="card-body">
        <h2 align='center'>{{ trans('cruds.ordonnanceDetail.title') }}</h2>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ordonnanceOrdonnanceDetails">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.article.fields.category') }}</th>
                        <th>{{ trans('cruds.ordonnanceDetail.fields.article') }}</th>
                        <th>{{ trans('cruds.article.fields.forme') }}</th>
                        <th>{{ trans('cruds.ordonnanceDetail.fields.posologie') }}</th>
                        <th>{{ trans('cruds.ordonnanceDetail.fields.quantity') }}</th>
                        <th>{{ trans('cruds.ordonnanceDetail.fields.duration') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordonnanceDetails as $key => $ordonnanceDetail)
                        <tr data-entry-id="{{ $ordonnanceDetail->id }}">
                            <td>{{ $ordonnanceDetail->article->category->name ?? '' }}</td>
                            <td>{{ $ordonnanceDetail->article->name ?? '' }}</td>
                            <td>{{ $ordonnanceDetail->article->forme->name ?? '' }}</td>
                            <td>{{ $ordonnanceDetail->posologie ?? '' }}</td>
                            <td>{{ $ordonnanceDetail->quantity ?? '' }}</td>
                            <td>{{ $ordonnanceDetail->duration ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
