<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('commande_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->integer('prix_unitaire')->nullable();
            $table->integer('montant_total')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
