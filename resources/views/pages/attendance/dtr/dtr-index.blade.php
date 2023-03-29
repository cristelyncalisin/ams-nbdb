@extends('layouts/contentNavbarLayout')

@section('title', 'DTR')

@section('vendor-style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Attendance /</span> Daily Time Record
</h4>

<!-- Responsive Table -->
@if(session('success'))
<div class="alert alert-primary d-flex alert-dismissible" role="alert">
    <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i class="bx bx-command fs-6"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Success!</h6>
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if(session('error'))
    <div>
        <div class="alert alert-dark d-flex mb-3 alert-dismissible" role="alert">
            <span class="badge badge-center rounded-pill bg-dark border-label-dark p-3 me-2"><i class="bx bx-error-alt fs-6"></i></span>
            <div class="d-flex flex-column ps-1">
                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Error!!</h6>
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@if (empty($dtr_details))
<div class="alert alert-primary d-flex" role="alert">
    <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i class="bx bx-info-circle fs-6"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Note:</h6>
        <span>Select the Date Inclusive and Division first in order to show the DTR Data.</span>
    </div>
</div>
@endif

<div class="d-flex">
    @include('pages.attendance.dtr.dtr-util')
</div>

@include('pages.attendance.dtr.dtr-details')
<!--/ Responsive Table -->
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}" wfd-invisible="true"></script>
@endsection

@section('page-script')
<script>
    var dateInclusivePicker = document.querySelector("#date-inclusive");
    dateInclusivePicker.flatpickr({
        mode: "range"
    });
</script>
@endsection