@extends('layouts/contentNavbarLayout')

@section('title', 'List of Employees')

@section('page-style')
    <style>
        .btn-close {
            right: -2rem;
            position: absolute;
            top: -2rem;
        }
    </style>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Employees /</span> List of Employees

    <div class="btn-group d-inline-block float-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="" data-bs-original-title="<span>Add a New Employee</span>">
        <button type="button" class="btn btn-primary add-employee-btn" data-bs-toggle="modal" data-bs-target=".employee-modal" data-link="{{ route('employees-create') }}">
            <i class="bx bx-user-plus bx-sm"></i>
        </button>
    </div>
</h4>

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

<!-- Responsive Table -->
<div class="card">
    <div class="table-responsive text-nowrap" style="min-height: 500px;">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Position</th>
                    <th>Type</th>
                    <th>Division</th>
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
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->personnel_type }}</td>
                        <td>{{ $employee->division }}</td>
                        <td class="text-center">
                            <input class="form-check-input" type="checkbox" disabled {{ $employee->is_active ? 'checked' : '' }}>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a  class="dropdown-item edit-employee-btn" 
                                        href="#" 
                                        data-bs-toggle="modal" data-bs-target=".employee-modal"
                                        data-link="{{ route('employees-edit', [$employee->employee_id]) }}"
                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Records Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mx-3 mt-4">
        <div class="d-flex float-end">
            @if(count($employees))
                {{ $employees->links() }}
            @endif
        </div>
    </div>
</div>
<!--/ Responsive Table -->

<div class="modal fade employee-modal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3 p-md-5">
        
    </div>
  </div>
</div>

@endsection

@section('page-script')
<script>
    $(document).on('click', '.add-employee-btn, .edit-employee-btn', function(e) {
        e.preventDefault();
        let link = $(this).data('link');
        $.ajax({
            url: link,
            success: function(response){
                $('.modal-content').html(response);
            }
        });
    });
</script>
@endsection