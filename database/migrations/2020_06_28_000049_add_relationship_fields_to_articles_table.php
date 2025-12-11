<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArticlesTable extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'category_fk_1685666')->references('id')->on('categories');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1685990')->references('id')->on('users');
        });
    }
}
