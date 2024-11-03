@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Complaint Details</h1>

    <div class="row">
        <div class="col-lg-8">
            <!-- Complaint Details Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary">{{ $complaint->title }}</h6>
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong> {{ $complaint->description }}</p>
                    <p><strong>Status:</strong> {{ $complaint->status->name }}</p>
                    <p><strong>Priority:</strong> {{ $complaint->priority }}</p>
                    <p><strong>Category:</strong> {{ $complaint->category->name }}</p>
                    <p><strong>Submitted By:</strong> {{ $complaint->user->name }} on {{ $complaint->submission_date }}</p>
                </div>
            </div>

            <!-- Status Update Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary">Update Status</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.complaints.update', $complaint->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status_id" id="status" class="form-control">
                                @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ $complaint->status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection