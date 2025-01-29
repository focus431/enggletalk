@extends('layout.mainlayout_admin')

@section('content')
  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">Account Awaiting Activation</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
              <li class="breadcrumb-item active">Awaiting Activation</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5>Your account is awaiting activation.</h5>
              <p>Thank you for registering. Your account needs to be approved by an admin before you can access the mentor
                dashboard. Please check back later.</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- /Page Wrapper -->
@endsection
