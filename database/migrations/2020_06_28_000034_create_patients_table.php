<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->integer('phone')->nullable();
            $table->integer('phone_2')->nullable();
            $table->date('birth_day');
            $table->string('email')->nullable();
            $table->integer('poids')->nullable();
            $table->integer('solde')->nullable();
            $table->integer('ca')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
