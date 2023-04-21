<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_data', function (Blueprint $table) {
            $table->id();
            $table->integer('file_id');
            $table->string('meter');
            $table->string('address');
            $table->integer('ip_id')->nullable();
            $table->string('pressure')->default('0.0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_data');
    }
}
