<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMedecinsTable extends Migration
{
    public function up()
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->unsignedInteger('grade_id');
            $table->foreign('grade_id', 'grade_fk_1685650')->references('id')->on('grades');
            $table->unsignedInteger('specialite_id');
            $table->foreign('specialite_id', 'specialite_fk_1685651')->references('id')->on('specilaltes');
        });
    }
}
