<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('login')->unique();
            $table->string('heslo');
            $table->string('email')->unique();
            $table->string('popis')->nullable();
            $table->enum('stav',['a','b','c'])->nullable();
            $table->string('rememberToken');
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                'login' => 'admin',

//                'heslo' => password_hash('admin123',1),
                'heslo' => md5('admin123'),
                'email' => 'admin@netfinancie.com',
                'rememberToken' => str_random(10)
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
