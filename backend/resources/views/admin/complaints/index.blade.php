@extends('layouts.main')

@section('title', 'Complaint Management')
@section('styles')
<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Complaint Management</h1>
</div>

<?php if(Session::has('success')): ?> 
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php  echo session('success'); ?>
</div>
<?php  elseif(Session::has('error')): ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class="fas fa-warning"></i>  <?php  echo session('error'); ?>
</div>
<?php endif; ?>

<!-- Complaints Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Complaints List</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="complaintsTable" width="100%" cellspacing="0">
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


@section('scripts')
<!-- Page level asset assets/plugin JavaScript-->
<script src="{{asset('assets/vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.js')}}"></script>

<script>
    $(function () {
    //   $("#categoryNav").addClass('active');
    //   $("#globalSettingsNav").addClass('active');
    //   $("#globalSettingsNav").closest(".has-treeview").addClass("menu-open");
    $('#complaintsTable').DataTable({
        'order': [],
        "responsive": true,
        "autoWidth": false,
    });

});
</script>

@endsection


@endsection

