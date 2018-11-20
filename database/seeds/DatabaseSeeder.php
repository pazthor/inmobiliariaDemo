<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'username' => 'mi_correo1'.'@correofalso.com',
            'password' => bcrypt('secret1'),
        ]);

        DB::table('users')->insert([
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'username' => 'mi_correo2'.'@correofalso.com',
            'password' => bcrypt('secret2'),
        ]);

        DB::table('users')->insert([
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'username' => 'mi_correo3'.'@correofalso.com',
            'password' => bcrypt('secret3'),
        ]);

        $projects = factory(App\Models\Project::class, 15)->create();
        $properties = factory(App\Models\Property::class, 50)->create();
    }
}
