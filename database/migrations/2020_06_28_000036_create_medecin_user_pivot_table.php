<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedecinUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('medecin_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_1686168')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('medecin_id');
            $table->foreign('medecin_id', 'medecin_id_fk_1686168')->references('id')->on('medecins')->onDelete('cascade');
        });
    }
}
