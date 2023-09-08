<?php

use Illuminate\Support\Facades\Route;

//deklarasi untuk cara kedua memanggil controller dengan memanggil namespace di controller terkait
// use App\Http\Controllers\HelloController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

//cara pertama memanggil controller
// Route::get('hello', "App\Http\Controllers\HelloController@index");

//cara kedua, membutuhkan deklarasi use
// Route::get('hello', [HelloController::class, 'index']);
// Route::get('world', [HelloController::class, 'world_message']);

Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authenticate']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('register', [AuthController::class, 'register_form']);
Route::post('register', [AuthController::class, 'register']);

Route::post('posts', [PostController::class, 'store']);
Route::get('posts', [PostController::class, 'index']);
//routing posts/create diletakkan diatas routing posts/{id} agar posts/{id} tidak membaca (create) sebagai variabel id
//sebaiknya route dengan variabel diletakkan dibawah karena laravel akan memprioritaskan route berdasarkan line nya
Route::get('posts/create', [PostController::class, 'create']);
Route::get('posts/{id}', [PostController::class, 'show']);
Route::get('posts/{id}/edit', [PostController::class, 'edit']);
Route::patch('posts/{id}', [PostController::class, 'update']);
Route::delete('posts/{id}', [PostController::class, 'destroy']);
