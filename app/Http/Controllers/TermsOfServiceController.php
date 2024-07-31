<?php

namespace App\Http\Controllers;

use App\Support\TranslationManager;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TermsOfServiceController extends Controller
{
    public function show(): View
    {
        $termsFile = app(TranslationManager::class)
            ->currentLocale()
            ->markdownFile('terms.md');

        return view('pages.terms-of-service', [
            'terms' => Str::markdown(file_get_contents($termsFile)),
        ]);
    }
}
