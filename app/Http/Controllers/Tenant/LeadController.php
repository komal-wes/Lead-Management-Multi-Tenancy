<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\LeadStoreRequest;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::all();
        return view('app.leads.index', ['leads' => $leads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lead = new Lead();
        return view('app.leads.create', ['lead' => $lead]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeadStoreRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        Lead::create($input);
        return redirect()->route('leads.index')->with('success', 'Lead added successfully!');
    }

    
    public function updateLead(LeadStoreRequest $request, $id)
    {
        Lead::where('id', $id)->update($request->validated());
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully!');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        return view('app.leads.create', ['lead' => $lead]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Lead::destroy($id);
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully!');
    }
}
