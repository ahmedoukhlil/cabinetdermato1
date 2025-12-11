<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationPricesTable extends Migration
{
    public function up()
    {
        Schema::create('consultation_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tarif');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
