<?php

namespace App\Http\Controllers;

use App\Support\TranslationManager;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DocumentationController extends Controller
{
    public function show(string $firstLevel, ?string $secondLevel = null): View
    {
        $documentationFile = app(TranslationManager::class)
            ->currentLocale()
            ->documentationFile($firstLevel, $secondLevel);

        return view('pages.documentation', [
            'title' => __(Str::headline($firstLevel))
                . ($secondLevel ? ' - ' . __(Str::headline($secondLevel)) : ''),
            'content' => Str::markdown(file_get_contents($documentationFile)),
        ]);
    }
}
