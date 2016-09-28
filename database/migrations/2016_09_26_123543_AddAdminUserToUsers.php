<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminUserToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $admins = array(
          array('name'=>'Admin', 'email'=>'admin@email.com', 'password'=>bcrypt('password'), 'user_type_id'=>1),
          array('name'=>'Kess', 'email'=>'kess@email.com', 'password'=>bcrypt('password'), 'user_type_id'=>1)
        );
        DB::table('users')->insert($admins);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
