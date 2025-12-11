<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-medecinAnalysis">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.analysi.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.analysi.fields.reference') }}
                        </th>
                        <th>
                            {{ trans('cruds.analysi.fields.patient') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($analysis as $key => $analysi)
                        <tr data-entry-id="{{ $analysi->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $analysi->id ?? '' }}
                            </td>
                            <td>
                                {{ $analysi->reference ?? '' }}
                            </td>
                            <td>
                                {{ $analysi->patient->name ?? '' }}
                            </td>
                            <td>
                                @can('analysi_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.analysis.show', $analysi->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('analysi_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.analysis.edit', $analysi->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('analysi_delete')
                                    <form action="{{ route('admin.analysis.destroy', $analysi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
