@extends('layouts.admin')
@section('content')
<h3 class="page-title">{{ trans('global.systemCalendar') }}</h3>
<div class="card">
    <div class="card-header">
        {{ trans('global.systemCalendar') }}
    </div>

    <div class="card-body">

        <div id='calendar'></div>
    </div>
</div>



@endsection

@section('scripts')
@parent

<script>
$(document).ready(function () {
    // page is now ready, initialize the calendar...
    events = {!! json_encode($events) !!}
    ;
    $('#calendar').fullCalendar({
        // put your options and callbacks here
        events: events,

    })
});
</script>
@stop