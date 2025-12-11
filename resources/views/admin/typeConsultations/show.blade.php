@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.typeConsultation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.type-consultations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.typeConsultation.fields.id') }}
                        </th>
                        <td>
                            {{ $typeConsultation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.typeConsultation.fields.name') }}
                        </th>
                        <td>
                            {{ $typeConsultation->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.type-consultations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#type_consultation_prices" role="tab" data-toggle="tab">
                {{ trans('cruds.consultationPrice.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="type_consultation_prices">
            @includeIf('admin.typeConsultations.relationships.typeConsultationPrices', ['consultationPrices' => $typeConsultation->typeConsultationPrices])
        </div>
    </div>
</div>

@endsection