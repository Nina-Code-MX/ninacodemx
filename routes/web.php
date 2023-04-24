<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

Route::get('/', function() {
	\Log::debug('route::get(/)', ['cookie' => Cookie::all()]);
	$lang = Cookie::get('lang') ?: config('app.locale');

	return redirect()->route('home', ['locale' => $lang], 301);
})->name('home.default');

Route::post('/lang-switcher', function(Request $request) {
	$lang = $request->get('lang') ?: config('app.locale');
	$lang_codes = config('app.locale_codes') ?? ['es' => 'mx'];

	if (!in_array($lang, array_keys($lang_codes))) {
		abort(400);
	}

	Cookie::queue(Cookie::make('lang', $lang));

	try {
		$previousRequest = app('request')->create(app('url')->previous());
		$routeName = app('router')->getRoutes()->match($previousRequest)->getName();

		return redirect()->route($routeName, ['locale' => $lang], 302);
	} catch (NotFoundHttpException $e) {
		return redirect()->route('home', ['locale' => $lang], 302);
	}
});

Route::prefix('{locale}')->where(['locale' => '[a-z]{2}'])->group(function ($router) {
	Route::get('/', App\Http\Livewire\Public\Home::class)->name('home');
	Route::get('/nosotros', App\Http\Livewire\Public\AboutUs::class)->name('aboutus');
	Route::get('/contacto', App\Http\Livewire\Public\Contact::class)->name('contact');

	Route::get('/signin', App\Http\Livewire\Auth\Signin::class)->name('signin');
});

Route::get('/nosotros', function() {
	$lang = Cookie::get('lang') ?: config('app.locale');

	return redirect()->route('aboutus', ['locale' => $lang], 301);
})->name('old.aboutus');

Route::get('/contacto', function() {
	$lang = Cookie::get('lang') ?: config('app.locale');

	return redirect()->route('contact', ['locale' => $lang], 301);
})->name('old.contact');

Route::group(['as' => 'admin', 'middleware' => ['auth', 'verified'], 'prefix' => '/admin'], function () {});