<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController {

    public function index() {
        $settings1 = [
            'chart_title' => 'Montant facturés les deux dernières semaine',
            'chart_type' => 'bar',
            'report_type' => 'group_by_date',
            'model' => 'App\\Facture',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'montant',
            'filter_field' => 'created_at',
            'filter_days' => '14',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-6',
            'entries_number' => '5',
        ];

        $chart1 = new LaravelChart($settings1);
        $settings2 = [
            'chart_title' => 'RdV deux dernières semaine',
            'chart_type' => 'bar',
            'report_type' => 'group_by_date',
            'model' => 'App\\Appointment',
            'group_by_field' => 'appointment_time',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_days' => '14',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-6',
            'entries_number' => '5',
        ];

        $chart2 = new LaravelChart($settings2);
        $settings3 = [
            'chart_title' => 'Dernières sorties de la caisse',
            'chart_type' => 'latest_entries',
            'report_type' => 'group_by_date',
            'model' => 'App\\OperationCash',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-6',
            'entries_number' => '10',
            'fields' => [
                'caisse' => 'name',
                'medecin' => 'full_name',
                'montant' => '',
                'created_at' => '',
            ],
        ];

        $settings3['data'] = [];

        if (class_exists($settings3['model'])) {
            $settings3['data'] = $settings3['model']::latest()
                    ->take($settings3['entries_number'])
                    ->get();
        }

        if (!array_key_exists('fields', $settings3)) {
            $settings3['fields'] = [];
        }

        $settings4 = [
            'chart_title' => 'Solde caisses',
            'chart_type' => 'latest_entries',
            'report_type' => 'group_by_date',
            'model' => 'App\\CashRegister',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-6',
            'entries_number' => '10',
            'fields' => [
                'name' => '',
                'solde' => '',
            ],
        ];

        $settings4['data'] = [];

        if (class_exists($settings4['model'])) {
            $settings4['data'] = $settings4['model']::latest()
                    ->take($settings4['entries_number'])
                    ->get();
        }

        if (!array_key_exists('fields', $settings4)) {
            $settings4['fields'] = [];
        }

        return view('home', compact('chart1', 'chart2', 'settings3', 'settings4'));
    }

}
