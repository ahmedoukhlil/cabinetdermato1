<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-patientOrdonnances">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.ordonnance.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.ordonnance.fields.medecin') }}
                        </th>
                        <th>
                            {{ trans('cruds.ordonnance.fields.reference') }}
                        </th>
                        <th>{{ trans('cruds.ordonnance.title') }}</th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordonnances as $key => $ordonnance)
                    <tr data-entry-id="{{ $ordonnance->id }}">
                        <td>
                            {{ $ordonnance->id ?? '' }}
                        </td>
                        <td>
                            {{ $ordonnance->medecin->name ?? '' }}
                        </td>
                        <td>
                            {{ $ordonnance->reference ?? '' }}
                        </td>
                        <td>
                            @foreach($ordonnance->ordonnanceOrdonnanceDetails as $key => $det)
                            <div>
                                <div class="row">
                                    <div class="col-md-8">{{$key+1}} - {{$det->medicament.' '.$det->posologie}}</div> 
                                    <div class=" col-md-3 pull-right">pendant {{$det->duration}} J</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-4 ">
                                        {{$det->forme->name.' '.$det->quantity}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </td>
                        <td>
                            @can('ordonnance_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.ordonnances.show', $ordonnance->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>