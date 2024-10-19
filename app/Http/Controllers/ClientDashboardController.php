<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Crm;
use App\Models\tutorRequest;
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
        $tutorRequests = $user->tutorRequests;
        $ongoingBookings = Booking::where('client_id', $user->id)->where('status', 'Active')->get();
        $completedBookings = Booking::where('client_id', $user->id)->where('status', 'Completed')->get();
        $closedBookings = Booking::where('client_id', $user->id)->where('status', 'Closed')->get();
        $newCRM = $user->crms->where('status', 'Pending');
        $ongoingCRM = $user->crms->where('status', 'Ongoing');
        $closedCRM = $user->crms->where('status', 'Closed');

        return view('client.dashboard', compact('newCRM', 'ongoingCRM', 'closedCRM','userProfile', 'user', 'tutorRequests', 'ongoingBookings', 'completedBookings', 'closedBookings'));
    }
}
