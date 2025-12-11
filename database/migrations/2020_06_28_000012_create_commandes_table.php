<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('montant_total')->nullable();
            $table->string('reference')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
