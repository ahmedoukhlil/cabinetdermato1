<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('montant')->nullable();
            $table->longText('comment')->nullable();
            $table->string('reference')->nullable();
            $table->string('type_facture');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
