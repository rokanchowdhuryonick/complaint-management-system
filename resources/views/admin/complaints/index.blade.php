@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Complaint Management</h1>
<p class="mb-4">Manage and monitor user complaints here.</p>

<!-- Complaints Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Complaints List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                    <tr>
                        <td>{{ $complaint->title }}</td>
                        <td>{{ $complaint->status->name }}</td>
                        <td>{{ $complaint->priority }}</td>
                        <td>{{ $complaint->category->name }}</td>
                        <td>
                            <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>