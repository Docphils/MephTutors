<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{
    // Admin Index Method
    public function index()
    {
       Gate::allows('Admin');
       
        return view('admin.payments.index');
    }


   }
