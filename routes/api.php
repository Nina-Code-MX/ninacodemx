<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceControllerV1;
use App\Http\Middleware\CustomAuthApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.v1.', 'prefix' => '/v1'], function () {
    Route::post('/mailchimp/newsltetter', [\App\Http\Controllers\Api\V1\Mailchimp\NewsletterController::class, 'index'])
        ->middleware('selfapi')
        ->name('mailchimp.newsltetter');

    Route::post('/login', [\App\Http\Controllers\Api\LoginControllerV1::class, 'login'])
        ->name('login.login');

    Route::middleware(['customauthapi'])->name('service.')->prefix('/services')->group(function () {
        Route::get('/', [ServiceControllerV1::class, 'getAll'])->name('getall');
        Route::post('/', [ServiceControllerV1::class, 'create'])->name('create');
        Route::get('/{service_id}', [ServiceControllerV1::class, 'get'])->name('get');
        Route::patch('/{service_id}', [ServiceControllerV1::class, 'update'])->name('update');
        Route::post('/{service_id}/translate/{lang}', [ServiceControllerV1::class, 'translate'])->where(['lang' => '[a-z]{2}'])->name('translate');
        Route::delete('/{service_id}', [ServiceControllerV1::class, 'delete'])->name('delete');
    });
});
