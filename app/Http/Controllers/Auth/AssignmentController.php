<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AssignmentRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AssignmentController extends Controller
{
    public function show(Request $request): View
    {
        return view('pages.auth.assignment', [
            'companies' => $request->user()->allCompanies()
                ->map->only('uuid', 'name'),
        ]);
    }

    public function store(AssignmentRequest $request): RedirectResponse
    {
        $company = Company::where('uuid', $request->company)->firstOrFail();

        $request->user()->forceFill([
            'current_company_id' => $company->id,
        ])->saveQuietly();

        return Redirect::route('dashboard');
    }

    public function update(AssignmentRequest $request): RedirectResponse
    {
        $company = Company::where('uuid', $request->company)->firstOrFail();

        $request->user()->forceFill([
            'current_company_id' => $company->id,
        ])->saveQuietly();

        return back(303);
    }
}
