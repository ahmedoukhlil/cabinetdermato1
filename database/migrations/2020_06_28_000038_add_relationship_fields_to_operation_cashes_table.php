<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOperationCashesTable extends Migration
{
    public function up()
    {
        Schema::table('operation_cashes', function (Blueprint $table) {
            $table->unsignedInteger('caisse_id');
            $table->foreign('caisse_id', 'caisse_fk_1740086')->references('id')->on('cash_registers');
            $table->unsignedInteger('medecin_id');
            $table->foreign('medecin_id', 'medecin_fk_1740087')->references('id')->on('medecins');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1740089')->references('id')->on('users');
        });
    }
}
