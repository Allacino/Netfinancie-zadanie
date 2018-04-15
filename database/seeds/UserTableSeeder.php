<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vymazanie existujucich dat
        DB::table('users')->delete();

        factory(App\User::class,10)->create();

        $this->command->info('Vygenerovany useri ...');
    }
}
