<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdonnancesTable extends Migration
{
    public function up()
    {
        Schema::table('ordonnances', function (Blueprint $table) {
            $table->unsignedInteger('medecin_id')->nullable();
            $table->foreign('medecin_id', 'medecin_fk_1686191')->references('id')->on('medecins');
            $table->unsignedInteger('patient_id')->nullable();
            $table->foreign('patient_id', 'patient_fk_1686192')->references('id')->on('patients');
            $table->unsignedInteger('consultation_id')->nullable();
            $table->foreign('consultation_id', 'consultation_fk_1739746')->references('id')->on('consultations');
        });
    }
}
