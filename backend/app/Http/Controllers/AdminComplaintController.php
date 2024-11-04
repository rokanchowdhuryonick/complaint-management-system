<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Status;
use Illuminate\Http\Request;

class AdminComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with(['status', 'category'])->get();

        return view('admin.complaints.index', compact('complaints'));
    }

    /**
     * 
     * @param  int  $id
     * @return \Illuminate\View\View
     * 
     */
    public function show($id)
    {
        // Find the complaint by ID with related status, category, and user
        $complaint = Complaint::with(['status', 'category', 'user'])->findOrFail($id);

        // Get all possible statuses for the status update dropdown
        $statuses = Status::all();

        // Return the view with the complaint details and statuses
        return view('admin.complaints.show', compact('complaint', 'statuses'));
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $complaint = Complaint::findOrFail($id);

        $complaint->status_id = $request->status_id;
        $complaint->save();

        if ($complaint->save()) {
            return redirect()
                ->route('admin.complaints.index')
                ->with('success', 'Complaint status updated successfully');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Failed to update complaint status');
        }
    }

}
