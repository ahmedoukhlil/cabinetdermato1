<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToConsultationsTable extends Migration
{
    public function up()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->unsignedInteger('rdv_id')->nullable();
            $table->foreign('rdv_id', 'rdv_fk_1694543')->references('id')->on('appointments');
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id', 'patient_fk_1694544')->references('id')->on('patients');
            $table->unsignedInteger('medecin_id');
            $table->foreign('medecin_id', 'medecin_fk_1694545')->references('id')->on('medecins');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1694551')->references('id')->on('users');
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_1694578')->references('id')->on('consultation_statuses');
        });
    }
}
