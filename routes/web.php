<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZozoController;
Route::get("/", [UserController::class,"index"])->name("users");
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');


Route::middleware(['auth'])->group(function () {
    
    // Route::resource('users', UserController::class);


});
Route::get('/login',[ZozoController::class, 'loginView'])->name('login');


Route::get('/users', [UserController::class, 'index']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/login', [UserController::class, 'login'])->name('login.process');
Route::get('/', [ZozoController::class, 'vue'])->name('login');
Route::post('/registration', [UserController::class, 'login'])->name('registration.process');


Route::get('/login',[ZozoController::class, 'login'])->name('login');
Route::get('/logout',  [ZozoController::class,'logout'])->name('logout');



