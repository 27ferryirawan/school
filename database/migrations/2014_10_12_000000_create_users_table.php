<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table  ->id()
                    ->string('name')
                    ->string('username')
                    ->string('email')->unique()
                    ->timestamp('email_verified_at')->nullable()
                    ->string('password')
                    ->enum('role', ['CUSTOMER', 'MANAJER', 'KASIR'])->default('CUSTOMER')
                    ->rememberToken()
                    ->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
