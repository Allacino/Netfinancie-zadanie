<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;


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
            $table->increments('id')->index();
            $table->string('meno')->nullable();
            $table->string('priezvisko')->nullable();
            $table->string('ulica')->nullable();
            $table->integer('cislo')->nullable();
            $table->string('psc')->nullable();
            $table->string('mesto')->nullable();
            $table->string('login',100)->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('popis')->nullable();
            $table->enum('stav',['a','b','c'])->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                'login' => 'admin',
                'meno' => 'Administrator',
                'priezvisko' => 'Systemovy',
                'password' => Hash::make('admin123'),//password_hash('admin123',1),
//                'heslo' => md5('admin123'),
                'email' => 'admin@admins.com',
        ]);
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
