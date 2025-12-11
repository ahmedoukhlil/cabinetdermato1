<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToConsultationPricesTable extends Migration
{
    public function up()
    {
        Schema::table('consultation_prices', function (Blueprint $table) {
            $table->unsignedInteger('type_id');
            $table->foreign('type_id', 'type_fk_1685772')->references('id')->on('type_consultations');
            $table->unsignedInteger('medecin_id');
            $table->foreign('medecin_id', 'medecin_fk_1685773')->references('id')->on('medecins');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1707397')->references('id')->on('users');
        });
    }
}
