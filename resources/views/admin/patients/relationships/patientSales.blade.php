<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-patientAnalysis">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.sale.fields.reference') }}
                        </th>
                        <th>
                            {{ trans('cruds.sale.fields.montant') }}
                        </th>
                        <th>{{ trans('global.created_at') }}</th>
                        <th>{{ trans('cruds.sale.fields.user') }}</th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $key => $sale)
                    <tr data-entry-id="{{ $sale->id }}">
                        <td>{{ $sale->reference ?? '' }}</td>
                        <td>{{ $sale->montant }}</td>
                        <td>{{ $sale->created_at }}</td>
                        <td>{{ $sale->user->name ?? '' }}</td>
                        <td>
                        @can('sale_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.sales.show', $sale->id) }}">
                                {{ trans('global.view') }}
                            </a>
                        @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
