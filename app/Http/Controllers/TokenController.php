<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laravel\Sanctum\PersonalAccessToken;

class TokenController extends Controller
{
    public function index(Request $request): View
    {
        return view('pages.tokens.index', [
            'tokens' => $request->user()->tokens()->paginate(),
            'token' => $request->session()->get('token'),
        ]);
    }

    public function create(): View
    {
        return view('pages.tokens.create');
    }

    public function store(TokenRequest $request): RedirectResponse
    {
        $token = $request->user()->createToken(
            name: $request->input('name'),
            expiresAt: $request->input('expires_at'),
        );

        return Redirect::route('tokens.index')->with(['token' => $token]);
    }

    public function destroy(PersonalAccessToken $token): RedirectResponse
    {
        $token->delete();

        return Redirect::route('tokens.index');
    }
}
