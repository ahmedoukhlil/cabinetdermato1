<div class="card">
    <div class="card-header">
        {{ trans('cruds.analyseDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-analyseAnalyseDetails">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.analyseDetail.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.analyseDetail.fields.analyse') }}
                        </th>
                        <th>
                            {{ trans('cruds.analyseDetail.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($analyseDetails as $key => $analyseDetail)
                        <tr data-entry-id="{{ $analyseDetail->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $analyseDetail->id ?? '' }}
                            </td>
                            <td>
                                {{ $analyseDetail->analyse->reference ?? '' }}
                            </td>
                            <td>
                                {{ $analyseDetail->name ?? '' }}
                            </td>
                            <td>



                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-analyseAnalyseDetails:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection