@extends('layouts/contentNavbarLayout')

@section('title', 'Merged Attendance')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Attendance /</span> Merged Attendance

    <div class="btn-group d-inline-block float-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Menu Actions</span>">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-menu me-1"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <h6 class="dropdown-header">Upload Attendance</h6>
            </li>
            <li><button class="dropdown-item" type="button">Upload from Google Form (.xlsx)</button></li>
            <li><a class="dropdown-item" href="{{route('attendance-biometrics-create')}}">Upload from Biometrics (.txt)</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <h6 class="dropdown-header">View Raw Extract</h6>
            </li>
            <li><button class="dropdown-item" type="button">From Google Form</button></li>
            <li><button class="dropdown-item" type="button">From Biometrics</button></li>
        </ul>
    </div>
</h4>

<!-- Responsive Table -->
@if(session('success'))
    <div class="alert alert-primary d-flex" role="alert">
        <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i class="bx bx-command fs-6"></i></span>
        <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Success!</h6>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

<div class="card">
    <div class="table-responsive text-nowrap" style="min-height: 500px;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date Entry</th>
                    <th>Employee</th>
                    <th>Type</th>
                    <th>Division</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Source</th>
                    <!-- <th class="text-center" title="Actions">
                        <i class="bx bx-menu"></i>
                    </th> -->
                </tr>
            </thead>
            <tbody>
                @forelse($time_entries as $time_entry)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ \Carbon\Carbon::parse($time_entry->date_entry)->format('M. d, Y') }}</td>
                    <td>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="avatar-wrapper">
                                <div class="avatar avatar-sm me-3">
                                    <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-user bx-xs"></i></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#" class="text-body text-truncate">
                                    <span class="fw-semibold">#{{ $time_entry->employee_id }} - {{ $time_entry->employee->last_name . ', ' . $time_entry->employee->first_name }}</span>
                                </a>
                                <a href="mailto:{{ $time_entry->employee->email }}" target="_blank"><small class="text-muted">{{ $time_entry->employee->email }}</small></a>
                            </div>
                        </div>
                    </td>
                    <td>{{ $time_entry->employee->personnel_type }}</td>
                    <td>{{ $time_entry->employee->division }}</td>
                    <td>{{ \Carbon\Carbon::parse($time_entry->time_in)->format('h:i A') }}</td>
                    <td>{{ $time_entry->time_out ? \Carbon\Carbon::parse($time_entry->time_out)->format('h:i A') : '-' }}</td>
                    <td>
                        <span class="text-truncate d-flex align-items-center">
                            <span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">
                                @if($time_entry->source == 'Google Forms')
                                <i class="bx bx-detail bx-xs"></i>
                                @else
                                <i class="bx bxs-watch bx-xs"></i>
                                @endif
                            </span>{{ $time_entry->source }}
                        </span>
                    </td>
                    <!-- <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show-alt me-1"></i> View</a>
                            </div>
                        </div>
                    </td> -->
                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center">No Records Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<!--/ Responsive Table -->
@endsection

@section('page-script')
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new Tooltip(tooltipTriggerEl);
    });
</script>
@endsection