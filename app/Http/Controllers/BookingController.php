<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;


class BookingController extends Controller
{
    public function index()
    {
        Gate::authorize('Admin');
            

        return view('admin.lessons.index');
    }
    
    //Client's Bookings
    public function clientBookings()
        {
            Gate::authorize('Client');

            return view('client.lessons.index');
        }

        
}
