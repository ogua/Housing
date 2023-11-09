<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housedetails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('house_id')->nullable();
            $table->text('title')->nullable();
            $table->text('imgs')->nullable();
            $table->text('features')->nullable();
            $table->text('otherdetails')->nullable();
            $table->text('agentname')->nullable();
            $table->text('agentcontact')->nullable();
            $table->text('agentwatsap')->nullable();
            $table->text('location')->nullable();
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
        Schema::dropIfExists('housedetails');
    }
}
