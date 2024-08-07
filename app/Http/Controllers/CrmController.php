<?php

namespace App\Http\Controllers;

use App\Models\Crm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CrmController extends Controller
{
    //
    public function index()
    {
        Gate::allows('Admin');
            $crm = Crm::all();

        return view('crm.index', compact('crm'));
    }

    //show method
    public function show($id)
    {
        $crm = Crm::findOrFail($id);

        return view('crm.show', compact('$crm'));
    }

    //create Method
    public function create()
    {

        return view('crm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'state' => 'required|in:Abia,Adamawa,AkwaIbom,Anambra,Bauchi,Bayelsa,Benue,Borno,CrossRiver,Delta,Ebonyi,Edo,Enugu,Gombe,Jigawa,Ekiti,Imo,Kaduna,Kano,Katsina,Kebbi,Kogi,Kwara,Lagos,Nasarawa,Niger,Ogun,Ondo,Osun,Oyo,Plateau,Rivers,Sokoto,Taraba,Yobe,Zamfara,FCT',
            'full_address' => 'required|string',
            'languages' => 'nullable|string',
            'learnersGrade' => 'required|in:under_12,teen,adult',
            'class_type' => 'nullable|in:home_tutoring,online',
            'status' => 'required|in:Pending,Cancelled,Ongoing,Closed',
            'remarks' => 'nullable|string',
            'request_type' =>'required|in:coding_tutor,club',
            'school_name' => 'nullable|string',
            'school_address' => 'nullable|string',
            'learnersNumber' => 'required|integer',
            'daysPerWeek' => 'required|integer|max:7',
            'days' => 'required|string',
            'duration' => 'required|string',
        ]);

        $crmData = $request->all();
        $crmData['user_id'] = Auth::user()->id;

        Crm::create($crmData);

        return redirect()->route('crm.index')->with('success', 'Request Submitted Successfully');
    }

    //Edit Method
    public function edit($id)
    {
        $crm = Crm::findOrFail($id);

        return view('crm.edit', compact('crm'));
    }

    //Update Method
    public function update(Request $request, $id)
    {    

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

        return redirect()->route('crm.index')->with('success', 'Request Updated Successfully');
    }

    //Delete Method
    public function destroy($id)
    {
        $crm = Crm::findOrFail($id);

        $crm->delete();

        return redirect()->route('crm.index')->with('success', 'Request deleted successfully');
    }

    //Change Status
    public function updateStauts(Request $request, $id)
    {
        Gate::authorize('Admin');
        $crm = Crm::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Pending,Ongoing,Closed',
        ]);

        $crm->update([
            'status' => $request->status
        ]);

        return redirect()->route('crm.index')->with('success', 'Request status updated successfully');

    }
}
