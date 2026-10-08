<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard placeholder.
     */
    public function index(Request $request): View
    {
        return view('admin.dashboard', [
            'admin' => $request->user(),
        ]);
    }
}
