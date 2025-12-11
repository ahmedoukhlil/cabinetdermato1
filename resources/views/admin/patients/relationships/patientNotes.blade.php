<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Note">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.objet') }}
                        </th>
                        <th>
                            {{ trans('cruds.note.fields.medecin') }}
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
                    @foreach($notes as $index=>$note)
                    <tr>
                        <td>
                            {{ $note->objet }}
                        </td>
                        <td>
                            {{ $note->medecin->name ?? '' }}
                        </td>
                        <td>
                            {{ $note->created_at }}
                        </td>
                        <td>
                            @can('note_show')
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.notes.show', $note->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
