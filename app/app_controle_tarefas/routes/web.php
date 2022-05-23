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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// definindo as rotas de task
Route::resource('task', 'App\Http\Controllers\TaskController');




Route::get('/test_message', function(){

    return new TestMessageMail();
});
