<?php

use Illuminate\Support\Facades\Route;
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
    return view('index');
});

Route::get('/test', function () {
    return view('index2');
});

// Route::get('/index', function () {
//     return view('index');
// });

// Route::resource('/blog', PostController::class);
Route::get('/blogIndex' , [PostController::class , "index"])->name('blogIndex');
Route::get('/blogCreate' , [PostController::class , "create"])->name('blogCreate');
Route::post('/blogStore' , [PostController::class , "store"])->name('blogStore');
Route::get('/blogShow/{slug}' , [PostController::class , "show"])->name('blogShow');
Route::get('/blogEdit/{id}' , [PostController::class , "edit"])->name('blogEdit');
Route::post('/blogUpdate/{id}' , [PostController::class , "update"])->name('blogUpdate');
Route::post('/blogDelete' , [PostController::class , "destroy"])->name('blogDelete');















Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
