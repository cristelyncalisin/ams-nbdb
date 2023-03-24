@extends('layouts/contentNavbarLayout')

@section('title', 'Biometrics Extract')

@section('content')
<h5 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Attendance /</span> Biometrics Extract
</h5>

<!-- Responsive Table -->
<div class="card">
    <div class="table-responsive text-nowrap" style="min-height: 500px;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>Employee</th>
                    <th>Personnel Type</th>
                    <th>Timestamp</th>
                    <th class="text-center" title="Actions">
                        <i class="bx bx-menu"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($biometrics as $biometric)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <th scope="row">{{ $biometric->employee_id }}</th>
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar avatar-sm me-3">
                                        <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-user bx-xs"></i></span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-body text-truncate">
                                        <span class="fw-semibold">{{ $biometric->employee->last_name . ', ' . $biometric->employee->first_name }}</span>
                                    </a>
                                    <a href="mailto:{{ $biometric->employee->email }}" target="_blank"><small class="text-muted">{{ $biometric->employee->email }}</small></a>
                                </div>
                            </div>
                        </td>
                        <td>{{ $biometric->employee->personnel_type }}</td>
                        <td>{{\Carbon\Carbon::parse($biometric->timestamp)->format('M. d, Y H:i:s')}}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show-alt me-1"></i> View</a>
                                </div>
                            </div>
                        </td>
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