<?php

namespace App\Http\Controllers;

use App\Models\Crm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CrmController extends Controller
{
    //admin index
    public function index()
    {
        Gate::allows('Admin');
            $crm = Crm::all();

        return view('admin.crm.index', compact('crm'));
    }

    //admin show method
    public function show($id)
    {
        Gate::allows('Admin');
        $crm = Crm::findOrFail($id);

        return view('admin.crm.show', compact('crm'));
    }


    //Admin Edit Method
    public function edit($id)
    {
        $crm = Crm::findOrFail($id);

        return view('admin.crm.edit', compact('crm'));
    }

    //Client Edit Method
    public function clientedit($id)
    {
        $crm = Crm::findOrFail($id);

        return view('client.crm.edit', compact('crm'));
    }

    //Update Method
    public function update(Request $request, $id)
    {    
        Gate::authorize('Client');

        $request->validate([
            'user_id' => 'somtimes|exists:users,id',
            'start_date' => 'sometimes|date|after_or_equal:today',
            'state' => 'sometimes|in:Abia,Adamawa,AkwaIbom,Anambra,Bauchi,Bayelsa,Benue,Borno,CrossRiver,Delta,Ebonyi,Edo,Enugu,Gombe,Jigawa,Ekiti,Imo,Kaduna,Kano,Katsina,Kebbi,Kogi,Kwara,Lagos,Nasarawa,Niger,Ogun,Ondo,Osun,Oyo,Plateau,Rivers,Sokoto,Taraba,Yobe,Zamfara,FCT',
            'full_address' => 'sometimes|string',
            'languages' => 'nullable|string',
            'learnersGrade' => 'sometimes|in:under_12,teen,adult',
            'class_type' => 'nullable|in:home_tutoring,online',
            'status' => 'sometimes|in:Pending,Cancelled,Ongoing,Closed',
            'remarks' => 'nullable|string',
            'request_type' =>'sometimes|in:coding_tutor,club',
            'school_name' => 'nullable|string',
            'school_address' => 'nullable|string',
            'learnersNumber' => 'sometimes|integer',
            'daysPerWeek' => 'sometimes|integer|max:7',
            'days' => 'sometimes|string',
            'duration' => 'sometimes|string',
        ]);

        $crmData = $request->all();

        $crm = Crm::findOrFail($id);
        $crm->update($crmData);

        return redirect()->route('client.crm.index')->with('success', 'Request Updated Successfully');
    }

    //Admin Delete Method
    public function destroy($id)
    {
        $crm = Crm::findOrFail($id);

        $crm->delete();

        return redirect()->route('admin.crm.index')->with('success', 'Request deleted successfully');
    }

    //Client Delete Method
    public function clientDestroy($id)
    {
        $crm = Crm::findOrFail($id);

        $crm->delete();

        return redirect()->route('client.crm.index')->with('success', 'Request deleted successfully');
    }

    //Change Status
    public function updateStatus(Request $request, $id)
    {
        Gate::authorize('Admin');
        $crm = Crm::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Pending,Ongoing,Closed',
        ]);

        $crm->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.crm.index')->with('success', 'Request status updated successfully');

    }
}
