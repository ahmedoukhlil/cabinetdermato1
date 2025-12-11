<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisTable extends Migration
{
    public function up()
    {
        Schema::create('analysis', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('comment')->nullable();
            $table->string('reference')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
