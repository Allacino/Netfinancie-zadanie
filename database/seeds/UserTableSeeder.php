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

        DB::table('users')->insert(
            [
                'login' => 'admin',
                'meno' => 'Administrator',
                'priezvisko' => 'Systemovy',
                'password' => Hash::make('admin123'),    //password_hash('admin123',1),
                'email' => 'admin@admins.com',
            ]);

        factory(App\User::class,10)->create();

        $this->command->info('Vygenerovany useri ...');
    }
}
