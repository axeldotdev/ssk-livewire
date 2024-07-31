<?php

namespace App\Http\Controllers;

use App\Support\TranslationManager;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PrivacyPolicyController extends Controller
{
    public function show(): View
    {
        $policyFile = app(TranslationManager::class)
            ->currentLocale()
            ->markdownFile('policy.md');

        return view('pages.privacy-policy', [
            'policy' => Str::markdown(file_get_contents($policyFile)),
        ]);
    }
}
