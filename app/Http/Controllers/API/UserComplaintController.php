<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserComplaintController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $complaints = $user->complaints()->with(['status', 'category'])->get();

        return response()->json($complaints);
    }

    public function show($id)
    {
        $user = Auth::user();
        $complaint = $user->complaints()->with(['status', 'category'])->findOrFail($id);

        return response()->json($complaint);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'priority' => 'required|in:Low,Medium,High',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // File validation
    ]);

    $complaint = new Complaint($validated);
    $complaint->user_id = auth()->id();
    $complaint->submission_date = now();
    $complaint->status_id = 1; // Default to "Open" status

    // Handle file upload if an attachment is provided
    if ($request->hasFile('attachment')) {
        $complaint->attachment = $request->file('attachment')->store('attachments', 'public');
    }

    $complaint->save();

    return response()->json($complaint, 201);
}

}
