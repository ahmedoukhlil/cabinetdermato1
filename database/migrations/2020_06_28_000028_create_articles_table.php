<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('prix_aquisition')->nullable();
            $table->integer('prix')->nullable();
            $table->integer('seuil')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
