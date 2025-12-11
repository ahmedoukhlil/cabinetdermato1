@extends('layouts.admin')
@section('content')
@can('note_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.notes.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.note.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.note.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
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
                        {{ trans('cruds.note.fields.patient') }}
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
                        {{ $note->patient->full_name }}
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



@endsection