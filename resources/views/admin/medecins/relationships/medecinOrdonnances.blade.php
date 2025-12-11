<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.ordonnance.fields.reference') }}
                        </th>
                        <th>
                            {{ trans('cruds.ordonnance.fields.patient') }}
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
                    @foreach($ordonnances as $key => $ordonnance)
                        <tr data-entry-id="{{ $ordonnance->id }}">
                            <td>
                                {{ $ordonnance->reference ?? '' }}
                            </td>
                            <td>
                                {{ $ordonnance->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $ordonnance->created_at ?? '' }}
                            </td>
                            <td>
                                @can('ordonnance_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.ordonnances.show', $ordonnance->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('ordonnance_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ordonnances.edit', $ordonnance->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('ordonnance_delete')
                                    <form action="{{ route('admin.ordonnances.destroy', $ordonnance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
