<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="col-lg-11 table table-bordered table-striped table-hover datatable-consultationAnalysis">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.analysi.fields.id') }}</th>
                        <th>{{ trans('cruds.analysi.fields.reference') }}</th>
                        <th>{{ trans('cruds.analysi.title') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($analysis as $key => $analysi)
                    <tr data-entry-id="{{ $analysi->id }}">
                        <td>{{ $analysi->id ?? '' }}</td>
                        <td>{{ $analysi->reference ?? '' }}</td>
                        <td>
                            @foreach($analysi->analyseAnalyseDetails as $det)
                            - {{$det->name}} <br/>
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.analysis.show', $analysi->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            <a class="btn btn-xs btn-success" href="{{ route('admin.analysis.print', $analysi->id) }}">
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
