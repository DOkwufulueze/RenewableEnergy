<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationDistributorToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //
      Schema::table('users', function(Blueprint $table) {
        $table->integer('location_distributor_id')->default(0);
      });

      // Schema::table('users', function(Blueprint $table) {
      //   $table->foreign('location_distributor_id')->references('id')->on('location_distributors')->onDelete('cascade');
      // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //
      // Schema::table('users', function(Blueprint $table) {
      //   $table->dropColumn('location_distributor_id');
      //   $table->dropForeign('users_location_distributor_id_foreign');
      // });
    }
}
