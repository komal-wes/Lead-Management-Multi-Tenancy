<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\LeadStoreRequest;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public $lead;
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }
    
    public function index()
    {
        $leads = Lead::all();
        return view('app.leads.index', ['leads' => $leads]);
    }
    
    public function create()
    {
        return view('app.leads.create', ['lead' => $this->lead]);
    }
    
    public function store(LeadStoreRequest $request)
    {
        Lead::create(array_merge($request->all(), ['user_id' =>Auth::id()]));
        return redirect()->route('leads.index')->with('success', trans('messages.lead.alert.created'));
    }
    
    public function updateLead(LeadStoreRequest $request, $id)
    {
        Lead::where('id', $id)->update($request->validated());
        return redirect()->route('leads.index')->with('success', trans('messages.lead.alert.updated'));
    }

    public function show(Lead $lead)
    {
        return view('app.leads.create', ['lead' => $lead]);
    }
    
    public function destroy(string $id)
    {
        $deleted = Lead::destroy($id);
        return redirect()->route('leads.index')->with('success',  trans('messages.lead.alert.deleted'));
    }
}
