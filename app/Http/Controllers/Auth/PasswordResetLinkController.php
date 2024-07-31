<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('pages.auth.forgot-password', [
            'status' => session('status'),
        ]);
    }

    /** @throws \Illuminate\Validation\ValidationException */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => [
                'required', 'string', 'lowercase',
                'email:rfc,dns,spoof', 'max:255',
            ],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
