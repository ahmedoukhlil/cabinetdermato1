<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id', 'patient_fk_1740157')->references('id')->on('patients');
            $table->unsignedInteger('medecin_id');
            $table->foreign('medecin_id', 'medecin_fk_1740158')->references('id')->on('medecins');
            $table->unsignedInteger('visite_id');
            $table->foreign('visite_id', 'visite_fk_1740160')->references('id')->on('type_visites');
            $table->unsignedInteger('consultation_id')->nullable();
            $table->foreign('consultation_id', 'consultation_fk_1740161')->references('id')->on('type_consultations');
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_1740163')->references('id')->on('rdv_statuses');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1740165')->references('id')->on('users');
        });
    }
}
