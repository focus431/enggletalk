@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Mentee Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li>
                        <li class="breadcrumb-item active">Mentee Details</li>
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
                                <img src="/storage/{{ $mentee->avatar_path }}" alt="Avatar" class="avatar-img rounded-circle" style="width: 100px; height: 100px;">
                            </div>
                            <div>
                                <h4 class="card-title">{{ $mentee->first_name }} {{ $mentee->last_name }}</h4>
                                <p class="mb-0">ID: {{ $mentee->id }}</p>
                                <p class="mb-0">Role: {{ $mentee->role }}</p>
                                <p class="mb-0">Mobile: {{ $mentee->mobile }}</p>
                                <p class="mb-0">Email: {{ $mentee->email }}</p>
                                <p class="mb-0">City: {{ $mentee->city }}</p>
                            </div>
                        </div>
                        <h4>About Me</h4>
                        <p>{{ $mentee->about_me }}</p>
                        <h4>Details</h4>
                        <p><strong>Date of Birth:</strong> {{ $mentee->date_of_birth }}</p>
                        <p><strong>Gender:</strong> {{ $mentee->gender }}</p>
                        <p><strong>Address:</strong> {{ $mentee->address }}</p>
                        <p><strong>City:</strong> {{ $mentee->city }}</p>
                        <p><strong>State:</strong> {{ $mentee->state }}</p>
                        <p><strong>Zip Code:</strong> {{ $mentee->zip_code }}</p>
                        <p><strong>Country:</strong> {{ $mentee->country }}</p>
                        <p><strong>Created At:</strong> {{ $mentee->created_at }}</p>
                        <p><strong>Updated At:</strong> {{ $mentee->updated_at }}</p>
                        <p><strong>Activated:</strong> {{ $mentee->activated ? 'Yes' : 'No' }}</p>
                        <p><strong>Name your classroom:</strong> {{ $mentee->google_meet_code }}</p>
                        <p><strong>Total Duration:</strong> {{ $mentee->t_duration }}</p>
                        <p><strong>Classes Attended:</strong> {{ $mentee->t_classes }}</p>
                        <p><strong>Remaining Classes:</strong> {{ $mentee->remaining_classes }}</p>
                        <a href="/admin/mentee" class="btn btn-primary mt-3">Back to List</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->
@endsection
