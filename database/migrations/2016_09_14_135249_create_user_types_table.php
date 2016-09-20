<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    //
    Schema::create('user_types', function(Blueprint $table) {
      $table->increments('id');
      $table->string('user_type');
      $table->timestamps();
    });

    DB::table('user_types')->insert(
      array(
        array( 'user_type' => 'Admin' ),
        array('user_type' => 'Regular' )
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
    Schema::drop('user_types');
  }
}
