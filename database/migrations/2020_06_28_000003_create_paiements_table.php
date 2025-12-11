<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference')->nullable();
            $table->integer('montant');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
