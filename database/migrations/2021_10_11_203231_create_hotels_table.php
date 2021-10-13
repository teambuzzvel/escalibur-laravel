<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->text("description");
            $table->string("address");
            $table->string("latitude");
            $table->string("longitude");
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *


     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
