<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the authenticated customer profile placeholder.
     */
    public function show(Request $request): View
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }
}
