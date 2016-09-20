<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    //
    Schema::create('devices', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('energy_cost_per_hour');
      $table->integer('device_type_id')->unsigned();
      $table->integer('user_id')->unsigned();
      $table->timestamps();
    });

    //
    Schema::table('devices', function(Blueprint $table) {
      $table->foreign('device_type_id')->references('id')->on('device_types')->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
    Schema::drop('devices');
  }
}
