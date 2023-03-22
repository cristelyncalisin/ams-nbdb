@extends('layouts/contentNavbarLayout')

@section('title', 'List of Employees')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Employees /</span> List of Employees
</h4>

<!-- Responsive Table -->
<div class="card">
    <div class="table-responsive text-nowrap" style="min-height: 500px;">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Personnel Type</th>
                    <th>Date Hired</th>
                    <th>Date Separated</th>
                    <th class="text-center">Is Active?</th>
                    <th class="text-center" title="Actions">
                        <i class="bx bx-menu"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <th scope="row">{{ $employee->employee_id }}</th>
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar avatar-sm me-3">
                                        <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-user bx-xs"></i></span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-body text-truncate">
                                        <span class="fw-semibold">{{ $employee->last_name . ', ' . $employee->first_name }}</span>
                                    </a>
                                    <a href="mailto:{{ $employee->email }}" target="_blank"><small class="text-muted">{{ $employee->email }}</small></a>
                                </div>
                            </div>
                        </td>
                        <td>{{ $employee->personnel_type }}</td>
                        <td>{{\Carbon\Carbon::parse($employee->date_hired)->format('M. d, Y')}}</td>
                        <td>{{$employee->date_separated ? \Carbon\Carbon::parse($employee->date_separated)->format('M. d, Y') : '-'}}</td>
                        <td class="text-center">
                            <input class="form-check-input" type="checkbox" disabled {{ $employee->is_active ? 'checked' : '' }}>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Records Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<!--/ Responsive Table -->
@endsection