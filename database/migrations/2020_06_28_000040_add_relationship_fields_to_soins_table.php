<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSoinsTable extends Migration
{
    public function up()
    {
        Schema::table('soins', function (Blueprint $table) {
            $table->unsignedInteger('caisse_id');
            $table->foreign('caisse_id', 'caisse_fk_1739342')->references('id')->on('cash_registers');
        });
    }
}
