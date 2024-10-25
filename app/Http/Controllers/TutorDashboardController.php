<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorDashboardController extends Controller
{
    //
    public function dashboard()
    {
        return view('tutor.dashboard');
    }
}
