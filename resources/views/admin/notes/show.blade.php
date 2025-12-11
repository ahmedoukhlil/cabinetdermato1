@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.note.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                <div class="pull pull-right">

                    <a class="btn  btn-success" href="{{ route('admin.notes.print', $note->id) }}">
                        {{ trans('global.print') }}
                    </a>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.id') }}
                        </th>
                        <td>
                            {{ $note->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.patient') }}
                        </th>
                        <td>
                            {{ $note->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.objet') }}
                        </th>
                        <td>
                            {{ $note->objet }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.medecin') }}
                        </th>
                        <td>
                            {{ $note->medecin->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.note.fields.content') }}
                        </th>
                        <td>
                            {!! $note->content ?? '' !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection