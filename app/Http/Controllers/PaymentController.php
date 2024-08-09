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
            $payments = Payment::all();
       
        return view('admin.payments.index', compact('payments'));
    }

    // Tutor Index Method
    public function tutorIndex()
    {
        Gate::allows('Tutor');
    
            $payments = Payment::where('tutor_id', Auth::id())->get();
    
        return view('tutor.payments.index', compact('payments'));
    }

    //Admin Show Method
    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }

    //Tutor Show Method
    public function toturShow($id)
    {
        $payment = Payment::findOrFail($id);

        return view('tutor.payments.show', compact('payment'));
    }

    // Create Method
    public function create()
    {
        Gate::authorize('Admin');

        return view('admin.payments.create');
    }

    // Store Method
    public function store(Request $request)
    {
        Gate::authorize('Admin');

        $request->validate([
            'tutor_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric',
            'evidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'status' => 'required|in:Pending,Earned,Paid',
        ]);

        $paymentData = $request->all();
        
        if($request->hasFile('evidence')){
            $file = $request->file('evidence');
            $filePath = $file->store('tutor_payments', 'public'); // Store the file in the 'public/tutor_payments' directory
            $paymentData['evidence'] = $filePath; // Save the file path to the database
        }

        Payment::create($paymentData);

        return redirect()->route('admin.payments.index')->with('success', 'Payment saved successfully');
    }

    // Update Method
    public function update(Request $request, $id)
    {
        Gate::authorize('Admin');

        $payment = Payment::findOrFail($id);

        $request->validate([
            'tutor_id' => 'sometimes|exists:users,id',
            'booking_id' => 'sometimes|exists:bookings,id',
            'amount' => 'sometimes|numeric',
            'evidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'status' => 'sometimes|in:Pending,Earned,Paid',
        ]);

        $paymentData = $request->all();
        
        if($request->hasFile('evidence')){
            $file = $request->file('evidence');
            $filePath = $file->store('tutor_payments', 'public'); // Store the file in the 'public/tutor_payments' directory
            $paymentData['evidence'] = $filePath; // Save the file path to the database
        }

        $payment->update($paymentData);

        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully');
    }
}
