<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashRegistersTable extends Migration
{
    public function up()
    {
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->decimal('solde', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
