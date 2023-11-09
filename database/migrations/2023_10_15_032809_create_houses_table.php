<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('img')->nullable();
            $table->text('title')->nullable();
            $table->text('type')->nullable();
            $table->text('ctype')->nullable();
            $table->text('currency')->nullable();
            $table->text('px')->nullable();
            $table->text('details')->nullable();
            $table->text('numofdays')->nullable();
            $table->text('link')->nullable();
            $table->text('url')->nullable();
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
        Schema::dropIfExists('houses');
    }
}
