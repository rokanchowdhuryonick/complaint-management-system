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

        return response()->json([
            'status' => true,
            'message' => 'Complaints retrieved successfully',
            'data' => $complaints
        ], 200);
    }

    public function show($id)
    {
        try {
            $user = Auth::user();
            $complaint = $user->complaints()
                ->with(['status', 'category'])
                ->findOrFail($id);
    
            return response()->json([
                'status' => true,
                'message' => 'Complaint details retrieved successfully',
                'data' => $complaint
            ], 200);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Complaint not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve complaint details',
                'error' => $e->getMessage()
            ], 500);
        }
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

        try {
            $complaint = new Complaint($validated);
            $complaint->user_id = auth()->id();
            $complaint->submission_date = now();
            $complaint->status_id = 1; // Default to "Open" status
    
            // Handle file upload if an attachment is provided
            if ($request->hasFile('attachment')) {
                $complaint->attachment = $request->file('attachment')->store('attachments', 'public');
            }
    
            // Attempt to save the complaint
            if (!$complaint->save()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to save complaint data',
                    'data' => null,
                ], 500);
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Complaint created successfully',
                'data' => $complaint,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

}
