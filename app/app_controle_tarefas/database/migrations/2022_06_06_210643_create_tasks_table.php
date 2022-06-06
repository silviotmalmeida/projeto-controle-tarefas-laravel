<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {

            // colunas padrão do laravel
            $table->id();
            $table->timestamps();

            // colunas personalizadas da tabela
            $table->string('task', 200);
            $table->date('end_date_limit');

            // configuração da chave estrangeira para a tabela user (um para muitos):
            //// criação da coluna
            $table->integer('user_id');
            //// adição da restrição de integridade referencial
            $table->foreign('user_id')->references('id')->on('user');

            // coluna para permitir o soft delete
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
