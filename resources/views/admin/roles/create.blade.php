@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Programme</th>
                            <th scope="col">Listing</th>
                            <th scope="col">Création</th>
                            <th scope="col">Visualisation</th>
                            <th scope="col">Edition</th>
                            <th scope="col">Suppression</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modules as $module)
                        <tr>
                            <th>{{$module->name}}</th>
                            <td><input class="form-check-input" type="checkbox" name="permissions[]" value="{{ array_search($module->permission.'_access', $permissions)}}" }}></td>
                            <td><input class="form-check-input" type="checkbox" name="permissions[]" value="{{ array_search($module->permission.'_create', $permissions)}}" }}></td>
                            <td><input class="form-check-input" type="checkbox" name="permissions[]" value="{{ array_search($module->permission.'_show', $permissions)}}" }}></td>
                            <td><input class="form-check-input" type="checkbox" name="permissions[]" value="{{ array_search($module->permission.'_edit', $permissions)}}" }}></td>
                            <td><input class="form-check-input" type="checkbox" name="permissions[]" value="{{ array_search($module->permission.'_delete', $permissions)}}" }}></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection