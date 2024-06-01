<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Livewire\Redirector;

class LocaleHelper
{
	/**
	 * Detect locale
	 * 
	 * @param Request $request
	 * 
	 * @return Redirector|bool
	 */
	public static function detectLocale(Request $request, string $pageId = 'home'): Redirector|bool
	{
		$locale = $request->segment(1);
		\Log::debug('detectLocale', ['pageId' => $pageId, 'locale' => $locale]);

		if (in_array($locale, ['en', 'es'])) {
			App::setLocale($locale);
			Cookie::queue(Cookie::forever('lang', $locale));
		}

		if (!in_array($locale, ['en', 'es']) && preg_match('/^[a-z]{2}$/', $locale)) {
			return redirect(301)->route($pageId, ['locale' => 'es']);
		}

		return true;
	}
}