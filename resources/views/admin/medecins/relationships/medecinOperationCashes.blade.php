<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-medecinOperationCashes">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.operationCash.fields.caisse') }}
                        </th>
                        <th>
                            {{ trans('cruds.operationCash.fields.montant') }}
                        </th>
                        <th>
                            {{ trans('cruds.operationCash.fields.user') }}
                        </th>
                        <th>
                            {{ trans('global.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($operationCashes as $key => $operationCash)
                        <tr data-entry-id="{{ $operationCash->id }}">
                            <td>
                                {{ $operationCash->caisse->name ?? '' }}
                            </td>
                            <td>
                                {{ $operationCash->montant ?? '' }}
                            </td>
                            <td>
                                {{ $operationCash->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $operationCash->created_at ?? '' }}
                            </td>
                            <td>
                                @can('operation_cash_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.operation-cashes.show', $operationCash->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('operation_cash_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.operation-cashes.edit', $operationCash->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('operation_cash_delete')
                                    <form action="{{ route('admin.operation-cashes.destroy', $operationCash->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
