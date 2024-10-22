<?php

namespace App\Http\Controllers;

class ClientDashboardController extends Controller
{
    //
    public function dashboard()
    {
        return view('client.dashboard');
    }
}
