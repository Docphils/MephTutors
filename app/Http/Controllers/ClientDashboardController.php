<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Lesson;
use App\Models\User;
use App\Models\UserProfile;

class ClientDashboardController extends Controller
{
    //
    public function dashboard()
    {
        $userProfile = Auth::user()->userProfile;
        $bookings = Auth::user()->bookings;
        $user = Auth::user();
        $lessons = Auth::user()->lessons;
        $ongoingBookings = Booking::where('client_id', $user->id)->where('status', 'Active')->with('tutor')->get();
        $completedBookings = Booking::where('client_id', $user->id)->where('status', 'Completed')->with('tutor')->get();
        $closedBookings = Booking::where('client_id', $user->id)->where('status', 'Closed')->with('tutor')->get();

        return view('client.dashboard', compact('userProfile', 'user', 'lessons', 'ongoingBookings', 'completedBookings', 'closedBookings'));
    }
}
