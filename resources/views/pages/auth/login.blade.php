@extends('layouts/blankLayout')

@section('title', 'Login - NBDB Attendance Management')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center" style="margin-bottom: 1rem!important">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>100])</span>
            </a>
          </div>
          <!-- /Logo -->
          <h5 class="mb-4 text-center"><strong>ATTENDANCE MANAGEMENT</strong></h5>

          @if($errors->first('email'))
            <div>
              <div class="alert alert-dark d-flex mb-3" role="alert">
                <span class="badge badge-center rounded-pill bg-dark border-label-dark p-3 me-2"><i class="bx bx-error-alt fs-6"></i></span>
                <div class="d-flex flex-column ps-1">
                  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Error!!</h6>
                  <span>Login Failed! Please try again.</span>
                </div>
              </div>
            </div>
          @endif

          <form id="formAuthentication" class="mb-3" action="{{ route('auth-authenticate') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">Email / Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your email or username" value="{{old('username')}}" autofocus>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
</div>
@endsection