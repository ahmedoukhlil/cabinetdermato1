@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.motifCharge.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.motif-charges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.motifCharge.fields.id') }}
                        </th>
                        <td>
                            {{ $motifCharge->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.motifCharge.fields.name') }}
                        </th>
                        <td>
                            {{ $motifCharge->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.motif-charges.index') }}">
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
            <a class="nav-link" href="#motif_charges" role="tab" data-toggle="tab">
                {{ trans('cruds.charge.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="motif_charges">
            @includeIf('admin.motifCharges.relationships.motifCharges', ['charges' => $motifCharge->motifCharges])
        </div>
    </div>
</div>

@endsection