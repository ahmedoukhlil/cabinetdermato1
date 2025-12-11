<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFacturesTable extends Migration
{
    public function up()
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1694582')->references('id')->on('users');
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_1694591')->references('id')->on('facture_statuses');
        });
    }
}
