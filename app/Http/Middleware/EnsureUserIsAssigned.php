<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAssigned
{
    public function handle(
        Request $request,
        Closure $next,
    ): Response|RedirectResponse|null {
        if ($request->user()->allCompanies()->count() === 1) {
            $request->user()->forceFill([
                'current_company_id' => $request->user()->allCompanies()
                    ->first()
                    ->id,
            ])->saveQuietly();

            return $next($request);
        }

        if ($request->user()->currentCompany) {
            return $next($request);
        }

        return Redirect::route('assignment.show');
    }
}
