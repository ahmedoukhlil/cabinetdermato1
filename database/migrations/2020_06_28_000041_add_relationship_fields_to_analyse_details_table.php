<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAnalyseDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('analyse_details', function (Blueprint $table) {
            $table->unsignedInteger('analyse_id');
            $table->foreign('analyse_id', 'analyse_fk_1739900')->references('id')->on('analysis');
        });
    }
}
