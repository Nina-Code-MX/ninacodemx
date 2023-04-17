<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', App\Http\Livewire\Public\Home::class)->name('home');
Route::get('/en', App\Http\Livewire\Public\Home::class)->name('home');
Route::get('/signin', App\Http\Livewire\Auth\Signin::class)->name('signin');
Route::get('/en/signin', App\Http\Livewire\Auth\Signin::class)->name('signin');*/

Route::prefix('{locale}')->where(['locale' => '[a-z]{2}'])->group(function () {
	Route::get('/', App\Http\Livewire\Public\Home::class)->name('home');
	Route::get('/signin', App\Http\Livewire\Auth\Signin::class)->name('signin');
});

Route::group(['as' => 'admin', 'middleware' => ['auth', 'verified'], 'prefix' => '/admin'], function () {});