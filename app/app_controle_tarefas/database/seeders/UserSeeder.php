<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// importando a model
use App\Models\User;

// importando a classe de hash
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // laço para criação dos dados
        for ($i = 1; $i <= 9; $i++) {

            // obtendo a data e hora atuais
            $now = date("Y-m-d H:i:s");

            // criando o objeto e salvando no BD
            $user = new User();
            $user->name = "Usuario $i";
            $user->email = "usuario$i@email.com";
            $user->email_verified_at = $now;
            $user->password = Hash::make('12345678');
            $user->save();
        }
    }
}
