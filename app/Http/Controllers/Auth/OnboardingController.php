<?php

namespace App\Http\Controllers\Auth;

use App\Enums\OnboardingStep;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OnboardingController extends Controller
{
    public function show(OnboardingStep $onboardingStep): View
    {
        return view('pages.auth.onboarding', compact('onboardingStep'));
    }
}
