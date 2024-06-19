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
		'articles' => 'articles'
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
		'articles' => 'articulos'
	],
];

Route::get('/', function() use ($superLang) {
	$superLang = in_array($superLang, ['es', 'en']) ? $superLang : 'es';

	return redirect()->route('home', ['locale' => $superLang], 301);
})->name('home.default');

Route::post('/lang-switcher', function(Request $request) {
	$lang = $request->get('lang') ?: config('app.locale');
	$lang_codes = config('app.locale_codes') ?? ['es' => 'mx'];

	if (!in_array($lang, array_keys($lang_codes))) {
		abort(400);
	}

	dd($lang);

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
	Route::get('/', App\Livewire\Public\Home::class)->name('home');
});

foreach ($pagesTranslates AS $lang => $page) {
	Route::prefix('{locale}')->where(['locale' => '[a-z]{2}'])->group(function () use ($lang, $pagesTranslates) {
		Route::get('/' . ($pagesTranslates[$lang]['aboutus']), App\Livewire\Public\AboutUs::class)->name($lang . '.aboutus');
		Route::get('/' . ($pagesTranslates[$lang]['portfolio']), App\Livewire\Public\Portfolio::class)->name($lang . '.portfolio');

		Route::prefix('/' . ($pagesTranslates[$lang]['services']))->group(function () use ($lang, $pagesTranslates) {
			Route::get('/', App\Livewire\Public\Services::class)->name($lang . '.services');
			Route::get('/{slug}', App\Livewire\Public\Services::class)->name($lang . '.services.slug');
		});

		Route::prefix('/' . ($pagesTranslates[$lang]['articles']))->group(function () use ($lang, $pagesTranslates) {
			Route::get('/', App\Livewire\Public\Articles::class)->name($lang . '.articles');
			Route::get('/{slug}', App\Livewire\Public\Articles::class)->name($lang . '.articles.slug');
		});

		Route::get('/' . ($pagesTranslates[$lang]['pricing']), App\Livewire\Public\Pricing::class)->name($lang . '.pricing');
		Route::get('/' . ($pagesTranslates[$lang]['contact']), App\Livewire\Public\Contact::class)->name($lang . '.contact');
		// Route::get('/' . ($pagesTranslates[$lang]['signin']), App\Livewire\Auth\Signin::class)->name($lang . '.signin');
		Route::get('/' . ($pagesTranslates[$lang]['terms']), App\Livewire\Public\Terms::class)->name($lang . '.terms');
		Route::get('/' . ($pagesTranslates[$lang]['privacy']), App\Livewire\Public\Privacy::class)->name($lang . '.privacy');
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

/*Route::get('', function(Request $request) {
	return response()->json(['message' => 'Whats going on'], 200);
})->name('login');*/

Route::get('/login', App\Livewire\Login::class)->name('login');
Route::post('/logout', App\Livewire\Login::class)->name('logout');

Route::group(['as' => 'admin', 'middleware' => ['auth', 'verified'], 'prefix' => '/admin'], function () {
	Route::get('/', App\Livewire\Admin\Dashboard::class)->name('.dashboard');

	Route::group(['as' => '.contact', 'prefix' => '/contact'], function () {
		Route::get('/', App\Livewire\Admin\ContactListing::class)->name('.listing');
	});

	Route::group(['as' => '.portfolio', 'prefix' => '/portfolio'], function () {
		Route::get('/', App\Livewire\Admin\PortfolioListing::class)->name('.listing');
		Route::get('/create', App\Livewire\Admin\PortfolioCreate::class)->name('.create');
		Route::get('/edit/{model}', App\Livewire\Admin\PortfolioEdit::class)->name('.edit');
	});

	Route::group(['as' => '.team', 'prefix' => '/team'], function () {
		Route::get('/', App\Livewire\Admin\TeamListing::class)->name('.listing');
		Route::get('/creaet', App\Livewire\Admin\TeamCreate::class)->name('.create');
		Route::get('/edit/{model}', App\Livewire\Admin\TeamEdit::class)->name('.edit');
	});

	Route::group(['as' => '.service', 'prefix' => '/service'], function () {
		Route::get('/', App\Livewire\Admin\ServiceListing::class)->name('.listing');
		Route::get('/creaet', App\Livewire\Admin\ServiceCreate::class)->name('.create');
		Route::get('/edit/{model}', App\Livewire\Admin\ServiceEdit::class)->name('.edit');
	});

	Route::group(['as' => '.translate', 'prefix' => '/translate'], function () {
		Route::get('/', App\Livewire\Admin\TranslateListing::class)->name('.listing');
		Route::get('/creaet', App\Livewire\Admin\TranslateCreate::class)->name('.create');
		Route::get('/edit/{model}', App\Livewire\Admin\TranslateEdit::class)->name('.edit');
	});

	Route::group(['as' => '.article', 'prefix' => '/article'], function () {
		Route::get('/', App\Livewire\Admin\ArticleListing::class)->name('.listing');
		Route::get('/create', App\Livewire\Admin\ArticleCreate::class)->name('.create');
		Route::get('/edit/{model}', App\Livewire\Admin\ArticleEdit::class)->name('.edit');
	});

});