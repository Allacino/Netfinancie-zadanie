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
            $table->string('meno');
            $table->string('priezvisko');
            $table->string('ulica');
            $table->integer('cislo');
            $table->integer('psc');
            $table->string('mesto');
            $table->string('login')->unique();
            $table->string('heslo');
            $table->string('email')->unique();
            $table->string('popis');
            $table->enum('stav',['a','b','c']);
            $table->timestamps();
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
