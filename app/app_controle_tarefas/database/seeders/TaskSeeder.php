<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// importando as models
use App\Models\User;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // consultando o valor do último usuário cadastrado
        $user_range = User::max('id');

        // laço para criação dos dados
        for ($i = 1; $i <= 100; $i++) {

            // sorteando um cliente
            $user_id = rand(1, $user_range);

            // sorteando um timestamp
            $timestamp = date("Y-m-d H:i:s", mt_rand(1, time()));

            // criando o objeto e salvando no BD
            Task::create([
                'task' => "Tarefa $i",
                'end_date_limit' => $timestamp,
                'user_id' => $user_id,
            ]);
        }
    }
}
