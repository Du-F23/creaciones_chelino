<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
    Route::get(
        'dashboard',
        function () {
            return view('dashboard');
        }
    )->name('dashboard');
    Route::get(
        'profile',
        function () {
            return view('profile');
        }
    )->name('profile');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get(
        '/login',
        function () {
            return view('dashboard');
        }
    )->name('sign-up');


    Route::resource('productos', ProductsController::class);
    Route::resource('carrito', CartController::class);
    Route::resource('compras', CartShopController::class);
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    Route::resource('roles', RolController::class);
    Route::get('/categorias', [CategoryController::class, 'index']);
    Route::get('/categorias/create', [CategoryController::class, 'create']);
    Route::post('/categorias', [CategoryController::class, 'store']);
    Route::get('/categorias/{category}/edit', [CategoryController::class, 'edit']);
    Route::put('/categorias/{category}', [CategoryController::class, 'update']);
    Route::delete('/categorias/{category}', [CategoryController::class, 'destroy']);
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
