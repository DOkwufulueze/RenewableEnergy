<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceTypesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
    Schema::create('device_types', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->timestamps();
    });

    DB::table('device_types')->insert(
      array(
        array('name' => 'Shiftable'),
        array('name' => 'Unshiftable')
      )
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    //
    Schema::drop('device_types');
  }
}
