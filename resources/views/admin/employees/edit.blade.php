@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employee.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employees.update", [$employee->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="matricule">{{ trans('cruds.employee.fields.matricule') }}</label>
                <input class="form-control {{ $errors->has('matricule') ? 'is-invalid' : '' }}" type="number" name="matricule" id="matricule" value="{{ old('matricule', $employee->matricule) }}" step="1" required>
                @if($errors->has('matricule'))
                    <div class="invalid-feedback">
                        {{ $errors->first('matricule') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.matricule_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nni">{{ trans('cruds.employee.fields.nni') }}</label>
                <input class="form-control {{ $errors->has('nni') ? 'is-invalid' : '' }}" type="number" name="nni" id="nni" value="{{ old('nni', $employee->nni) }}" step="1" required>
                @if($errors->has('nni'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nni') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.nni_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.employee.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="emploi_id">{{ trans('cruds.employee.fields.emploi') }}</label>
                <select class="form-control select2 {{ $errors->has('emploi') ? 'is-invalid' : '' }}" name="emploi_id" id="emploi_id" required>
                    @foreach($emplois as $id => $entry)
                        <option value="{{ $id }}" {{ (old('emploi_id') ? old('emploi_id') : $employee->emploi->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('emploi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('emploi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.emploi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.employee.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}" step="1">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="salary">{{ trans('cruds.employee.fields.salary') }}</label>
                <input class="form-control {{ $errors->has('salary') ? 'is-invalid' : '' }}" type="number" name="salary" id="salary" value="{{ old('salary', $employee->salary) }}" step="1" required>
                @if($errors->has('salary'))
                    <div class="invalid-feedback">
                        {{ $errors->first('salary') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.salary_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="recruitement_date">{{ trans('cruds.employee.fields.recruitement_date') }}</label>
                <input class="form-control date {{ $errors->has('recruitement_date') ? 'is-invalid' : '' }}" type="text" name="recruitement_date" id="recruitement_date" value="{{ old('recruitement_date', $employee->recruitement_date) }}" required>
                @if($errors->has('recruitement_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('recruitement_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.recruitement_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="photo">{{ trans('cruds.employee.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.photo_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.employees.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($employee) && $employee->photo)
      var file = {!! json_encode($employee->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection