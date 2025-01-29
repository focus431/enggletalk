@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Mentor Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li>
                        <li class="breadcrumb-item active">Mentor Details</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="mr-3">
                                <img src="/storage/{{ $mentor->avatar_path }}" alt="Avatar" class="avatar-img rounded-circle" style="width: 100px; height: 100px;">
                            </div>
                            <div>
                                <h4 class="card-title">{{ $mentor->first_name }} {{ $mentor->last_name }}</h4>
                                <p class="mb-0">ID: {{ $mentor->id }}</p>
                                <p class="mb-0">Role: {{ $mentor->role }}</p>
                                <p class="mb-0">Mobile: {{ $mentor->mobile }}</p>
                                <p class="mb-0">Email: {{ $mentor->email }}</p>
                                <p class="mb-0">City: {{ $mentor->city }}</p>
                            </div>
                        </div>
                        <h4>About Me</h4>
                        <p>{{ $mentor->about_me }}</p>
                        <h4>Details</h4>
                        <p><strong>Date of Birth:</strong> {{ $mentor->date_of_birth }}</p>
                        <p><strong>Gender:</strong> {{ $mentor->gender }}</p>
                        <p><strong>Address:</strong> {{ $mentor->address }}</p>
                        <p><strong>City:</strong> {{ $mentor->city }}</p>
                        <p><strong>State:</strong> {{ $mentor->state }}</p>
                        <p><strong>Zip Code:</strong> {{ $mentor->zip_code }}</p>
                        <p><strong>Country:</strong> {{ $mentor->country }}</p>
                        <p><strong>Created At:</strong> {{ $mentor->created_at }}</p>
                        <p><strong>Updated At:</strong> {{ $mentor->updated_at }}</p>
                        <p><strong>Activated:</strong> {{ $mentor->activated ? 'Yes' : 'No' }}</p>
                        <p><Google>Name your classroom:</strong> {{ $mentor->google_meet_code }}</p>
                        <p><strong>Total Duration:</strong> {{ $mentor->t_duration }}</p>
                        <p><strong>Classes Taught:</strong> {{ $mentor->t_classes }}</p>
                        <p><strong>Remaining Classes:</strong> {{ $mentor->remaining_classes }}</p>
                        <a href="/admin/mentor" class="btn btn-primary mt-3">Back to List</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->
@endsection
