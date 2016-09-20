<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceUsagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    //
    Schema::create('device_usages', function(Blueprint $table) {
      $table->increments('id');
      $table->integer('device_id')->unsigned();
      $table->dateTime('time_on')->nullable();
      $table->dateTime('time_off')->nullable();
      $table->timestamps();
    });

    //
    Schema::table('device_usages', function(Blueprint $table) {
      $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
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
    Schema::drop('device_usages');
  }
}
