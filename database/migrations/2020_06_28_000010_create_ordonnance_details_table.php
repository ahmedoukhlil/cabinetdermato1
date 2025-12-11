<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdonnanceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('ordonnance_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('medicament');
            $table->string('posologie');
            $table->integer('quantity')->nullable();
            $table->integer('duration')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
