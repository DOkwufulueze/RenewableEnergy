<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationDistributors extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    //
    Schema::create('location_distributors', function(Blueprint $table) {
      $table->increments('id');
      $table->integer('location_id')->unsigned();
      $table->integer('distributor_id')->unsigned();
      $table->string('scheduled_energy_per_hour');
      $table->timestamps();
    });

    //
    Schema::table('location_distributors', function(Blueprint $table) {
      $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
      $table->foreign('distributor_id')->references('id')->on('distributors')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    //
    Schema::drop('location_distributors');
  }
}
