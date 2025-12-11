<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedecinsTable extends Migration
{
    public function up()
    {
        Schema::create('medecins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->integer('phone')->nullable();
            $table->integer('phone_2')->nullable();
            $table->string('email')->nullable();
            $table->integer('free_days');
            $table->integer('daily_consultation')->nullable();
            $table->integer('daily_rdv')->nullable();
            $table->integer('consultation_duration')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
