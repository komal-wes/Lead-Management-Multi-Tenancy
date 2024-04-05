<?php

namespace App\Http\Controllers\Tenant;

use App\Constants\Lead\SourceConstants;
use App\Constants\Lead\StatusConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\LeadStoreRequest;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
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
        $lead_sources = SourceConstants::getSources();
        $statuses = StatusConstants::getStatuses();
        return view('app.leads.create', ['lead_sources' => $lead_sources,'statuses' => $statuses]);
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
        $lead = Lead::find($id);
        if ($lead) {
            $lead->update($request->validated());
        }
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully!');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        $lead_sources = SourceConstants::getSources();
        $statuses = StatusConstants::getStatuses();
        return view('app.leads.create', ['lead_sources' => $lead_sources,'statuses' => $statuses,'lead' => $lead]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lead = Lead::find($id);
        if ($lead) {
            $lead->delete();
        }
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully!');
    }
}
