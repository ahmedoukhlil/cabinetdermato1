@can($viewGate)
<a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
    {{ trans('global.view') }}
</a>
@endcan
@can($editGate)
<a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
    {{ trans('global.edit') }}
</a>
@endcan
@can($deleteGate)
<form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
</form>
@endcan

@if($crudRoutePart == 'patients')
@can('appointment_create')
<a class="btn btn-xs btn-success" href="{{ route('admin.appointments.create', $row->id) }}"> RdV </a>
@endcan

@can('paiement_create')
@if($row->solde > 0)
<a class="btn btn-xs btn-success" href="{{ route('admin.paiements.create', $row->id) }}"> Paiement </a>
@endif
@endcan

@endif


@if($crudRoutePart == 'ordonnances')
<a class="btn btn-xs btn-success" href="{{ route('admin.ordonnances.print', $row->id) }}"> {{trans('global.print')}} </a>
@if($row->articles_number == 0 && $row->created_at->format('Y-m-d') == NOW()->format('Y-m-d') )
<a class="btn btn-xs btn-primary" href="{{ route('admin.ordonnances.livraison', $row->id) }}"> {{trans('global.livraison')}} </a>
@endif
@endif
@if($crudRoutePart == 'analysis')
<a class="btn btn-xs btn-success" href="{{ route('admin.analysis.print', $row->id) }}"> {{trans('global.print')}} </a>
@endif