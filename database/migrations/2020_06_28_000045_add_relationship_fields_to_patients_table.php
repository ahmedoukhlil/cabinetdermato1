<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPatientsTable extends Migration
{
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->unsignedInteger('genre_id');
            $table->foreign('genre_id', 'genre_fk_1685792')->references('id')->on('genres');
        });
    }
}
