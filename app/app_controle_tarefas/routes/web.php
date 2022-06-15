<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// importando o controlador do email
use App\Mail\TestMessageMail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ativando as rotas de autenticação, com exigencia de verificação do email cadastrado
Auth::routes(['verify' => true]);

// definindo a rota do home, acessível somente a usuários cadastrados e com email verificado
// como a aplicação não utiliza esta rota, a mesma foi desabilitada
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
//     ->name('home')
//     ->middleware('verified');


// Rotas de Task
// adicionando a rota para exportação, com parâmetro type obrigatório, acessível somente a usuários cadastrados e com email verificado
Route::get('/task/export/{type}', 'App\Http\Controllers\TaskController@export')
    ->name('task.export')
    ->middleware('verified');
// definindo as demais rotas de task, acessíveis somente a usuários cadastrados e com email verificado
Route::resource('task', 'App\Http\Controllers\TaskController')
    ->middleware('verified');





Route::get('/test_message', function () {

    return new TestMessageMail();
});
