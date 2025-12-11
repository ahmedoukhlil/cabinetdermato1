<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoinsTable extends Migration
{
    public function up()
    {
        Schema::create('soins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->decimal('prix', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
