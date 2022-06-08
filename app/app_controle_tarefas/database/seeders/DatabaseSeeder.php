<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        // listando os seeders a serem disparados
        $this->call(UserSeeder::class);
        $this->call(TaskSeeder::class);
    }
}
