<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

class SystemCalendarController extends Controller {

    public $sources = [
        [
            'model' => '\\App\\Appointment',
            'date_field' => 'appointment_time',
            'field' => 'id',
            'prefix' => 'appointment_time',
            'suffix' => '',
            'route' => 'admin.appointments.show',
        ],
    ];

    public function index() {
        $events = [];
//        DB::enableQueryLog();
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']} . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url' => route($source['route'], $model->id),
                ];
            }
        }
//        dd(DB::getQueryLog());

        return view('admin.calendar.calendar', compact('events'));
    }

}
