<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerificationPromptController extends Controller
{
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->isVerified()
            ? redirect()->intended(route('dashboard', absolute: false))
            : view('pages.auth.verify-user', [
                'status' => session('status'),
                'signMethod' => $request->signMethod ?? 'email',
            ]);
    }
}
