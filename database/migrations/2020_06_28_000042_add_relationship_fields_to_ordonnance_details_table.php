<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdonnanceDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('ordonnance_details', function (Blueprint $table) {
            $table->unsignedInteger('ordonnance_id');
            $table->foreign('ordonnance_id', 'ordonnance_fk_1728110')->references('id')->on('ordonnances');
            $table->unsignedInteger('forme_id')->nullable();
            $table->foreign('forme_id', 'forme_fk_1728141')->references('id')->on('forme_medicaments');
        });
    }
}
