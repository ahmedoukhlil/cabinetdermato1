<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="col-lg-11 table table-bordered table-striped table-hover datatable datatable-consultationOrdonnances">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.ordonnance.fields.id') }}</th>
                        <th>{{ trans('cruds.ordonnance.fields.reference') }}</th>
                        <th>{{ trans('cruds.ordonnance.title') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordonnances as $key => $ordonnance)
                    <tr data-entry-id="{{ $ordonnance->id }}">
                        <td>{{ $ordonnance->id ?? '' }}</td>
                        <td>{{ $ordonnance->reference ?? '' }}</td>
                        <td>
                            @foreach($ordonnance->ordonnanceOrdonnanceDetails as $key => $det)
                            <div>
                                <div class="row">
                                    <div class="col-md-8">{{$key+1}} - {{$det->medicament.' '.$det->posologie}}</div> 
                                    <div class=" col-md-3 pull-right">pendant {{$det->duration}} J</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-4 ">
                                        @if($det->article && $det->article->forme)
                                            {{$det->article->forme->name.' '.$det->quantity}}
                                        @else
                                            {{$det->quantity ?? ''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.ordonnances.show', $ordonnance->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            <a class="btn btn-xs btn-success" href="{{ route('admin.ordonnances.print', $ordonnance->id) }}">
                                {{ trans('global.print') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
