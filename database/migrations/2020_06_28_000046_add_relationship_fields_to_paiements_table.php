<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaiementsTable extends Migration
{
    public function up()
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->unsignedInteger('facture_id')->nullable();
            $table->foreign('facture_id', 'facture_fk_1707389')->references('id')->on('factures');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1707396')->references('id')->on('users');
        });
    }
}
