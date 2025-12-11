<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-medecinConsultationPrices">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.consultationPrice.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.consultationPrice.fields.tarif') }}
                        </th>
                        <th>
                            {{ trans('cruds.consultationPrice.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultationPrices as $key => $consultationPrice)
                        <tr data-entry-id="{{ $consultationPrice->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $consultationPrice->type->name ?? '' }}
                            </td>
                            <td>
                                {{ $consultationPrice->tarif ?? '' }}
                            </td>
                            <td>
                                {{ $consultationPrice->user->name ?? '' }}
                            </td>
                            <td>
                                @can('consultation_price_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.consultation-prices.show', $consultationPrice->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('consultation_price_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.consultation-prices.edit', $consultationPrice->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('consultation_price_delete')
                                    <form action="{{ route('admin.consultation-prices.destroy', $consultationPrice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
