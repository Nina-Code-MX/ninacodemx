<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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

$superLang = Cookie::get('lang') ?: config('app.locale') ?: 'es';
$pagesTranslates = [
	'en' => [
		'aboutus' => 'about-us',
		'portfolio' => 'portfolio',
		'services' => 'services',
		'pricing' => 'pricing',
		'contact' => 'contact-us',
		'signin' => 'signin',
		'terms' => 'terms-and-conditions',
		'privacy' => 'privacy-policy',
	],
	'es' => [
		'aboutus' => 'nosotros',
		'portfolio' => 'portafolio',
		'services' => 'servicios',
		'pricing' => 'precios',
		'contact' => 'contacto',
		'signin' => 'iniciar-sesion',
		'terms' => 'terminos-y-condiciones',
		'privacy' => 'aviso-de-privacidad',
	],
];

Route::get('/', function() use ($superLang) {
	return redirect()->route('home', ['locale' => $superLang], 301);
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
		$routeNameArr = explode('.', $routeName);

		if (isset($routeNameArr[1]) && preg_match('/^[a-z]{2}$/', $routeNameArr[0])) {
			return redirect()->route($lang . '.' . $routeNameArr[1], ['locale' => $lang], 302);
		}

		return redirect()->route('home', ['locale' => $lang], 302);
	} catch (NotFoundHttpException $e) {
		return redirect()->route('home', ['locale' => $lang], 302);
	} catch (RouteNotFoundException $e) {
		return redirect()->route('home', ['locale' => $lang], 302);
	}
});

Route::prefix('{locale}')->where(['locale' => '[a-z]{2}'])->group(function ($router) {
	Route::get('/', App\Http\Livewire\Public\Home::class)->name('home');
});

foreach ($pagesTranslates AS $lang => $page) {
	Route::prefix('{locale}')->where(['locale' => '[a-z]{2}'])->group(function () use ($lang, $pagesTranslates) {
		Route::get('/' . ($pagesTranslates[$lang]['aboutus']), App\Http\Livewire\Public\AboutUs::class)->name($lang . '.aboutus');
		Route::get('/' . ($pagesTranslates[$lang]['portfolio']), App\Http\Livewire\Public\Portfolio::class)->name($lang . '.portfolio');

		Route::prefix('/' . ($pagesTranslates[$lang]['services']))->group(function () use ($lang, $pagesTranslates) {
			Route::get('/', App\Http\Livewire\Public\Services::class)->name($lang . '.services');
			Route::get('/{slug}', App\Http\Livewire\Public\Services::class)->name($lang . '.services.slug');
		});

		Route::get('/' . ($pagesTranslates[$lang]['pricing']), App\Http\Livewire\Public\Pricing::class)->name($lang . '.pricing');
		Route::get('/' . ($pagesTranslates[$lang]['contact']), App\Http\Livewire\Public\Contact::class)->name($lang . '.contact');
		Route::get('/' . ($pagesTranslates[$lang]['signin']), App\Http\Livewire\Auth\Signin::class)->name($lang . '.signin');
		Route::get('/' . ($pagesTranslates[$lang]['terms']), App\Http\Livewire\Public\Terms::class)->name($lang . '.terms');
		Route::get('/' . ($pagesTranslates[$lang]['privacy']), App\Http\Livewire\Public\Privacy::class)->name($lang . '.privacy');
	});
}

Route::get('/nosotros', function() use ($superLang) {
	return redirect()->route($superLang . '.aboutus', ['locale' => $superLang], 301);
})->name('old.aboutus');

Route::get('/portafolio', function() use ($superLang) {
	return redirect()->route($superLang . '.portfolio', ['locale' => $superLang], 301);
})->name('old.portfolio');

Route::get('/contacto', function() use ($superLang) {
	return redirect()->route($superLang . '.contact', ['locale' => $superLang], 301);
})->name('old.contact');

Route::get('/terminos-y-condiciones', function() use ($superLang) {
	return redirect()->route($superLang . '.terms', ['locale' => $superLang], 301);
})->name('old.terms');

Route::get('/politica-de-privacidad', function() use ($superLang) {
	return redirect()->route($superLang . '.privacy', ['locale' => $superLang], 301);
})->name('old.privacy');

Route::group(['as' => 'admin', 'middleware' => ['auth', 'verified'], 'prefix' => '/admin'], function () {});