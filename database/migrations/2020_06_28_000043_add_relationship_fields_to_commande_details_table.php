<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommandeDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('commande_details', function (Blueprint $table) {
            $table->unsignedInteger('article_id');
            $table->foreign('article_id', 'article_fk_1739329')->references('id')->on('articles');
            $table->unsignedInteger('commande_id');
            $table->foreign('commande_id', 'commande_fk_1739333')->references('id')->on('commandes');
        });
    }
}
