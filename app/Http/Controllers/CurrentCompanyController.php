<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CurrentCompanyController extends Controller
{
    public function edit(Request $request): View
    {
        return view('pages.company.edit', [
            'members' => $request->user()->currentCompany
                ->allUsers()
                ->map
                ->only(['uuid', 'fullname']),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->user()->currentCompany->update($request->all());

        return Redirect::route('company.edit');
    }
}
