<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-medecinConsultations">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.consultation.fields.rdv') }}
                        </th>
                        <th>
                            {{ trans('cruds.consultation.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.consultation.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultations as $key => $consultation)
                        <tr data-entry-id="{{ $consultation->id }}">
                            <td>
                                {{ $consultation->rdv->appointment_time ?? '' }}
                            </td>
                            <td>
                                {{ $consultation->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $consultation->status->name ?? '' }}
                            </td>
                            <td>
                                @can('consultation_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.consultations.show', $consultation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('consultation_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.consultations.edit', $consultation->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('consultation_delete')
                                    <form action="{{ route('admin.consultations.destroy', $consultation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
