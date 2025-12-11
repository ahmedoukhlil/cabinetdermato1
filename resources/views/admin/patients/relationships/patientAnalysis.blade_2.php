<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-patientAnalysis">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.analysi.fields.reference') }}
                        </th>
                        <th>
                            {{ trans('cruds.analysi.fields.medecin') }}
                        </th>
                        <th>{{ trans('cruds.analysi.title') }}</th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($analysis as $key => $analysi)
                    <tr data-entry-id="{{ $analysi->id }}">
                        <td>{{ $analysi->reference ?? '' }}</td>
                        <td>{{ $analysi->medecin->full_name ?? '' }}</td>
                        <td>
                            @foreach($analysi->analyseAnalyseDetails as $det)
                            - {{$det->name}} <br/>
                            @endforeach
                        </td>
                        <td>
                            @can('analysi_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.analysis.show', $analysi->id) }}">
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
