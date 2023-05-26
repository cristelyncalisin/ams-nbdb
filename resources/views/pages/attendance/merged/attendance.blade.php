@extends('layouts/contentNavbarLayout')

@section('title', 'Merged Attendance')

@section('vendor-style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Attendance /</span> Attendance Records
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

<div class="d-flex">
    <div id="accordionPopoutIcon" class="accordion accordion-popout mb-4 me-3 flex-fill">
        <div class="accordion-item card">
            <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionPopoutIconOne">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionPopoutIcon-1" aria-controls="accordionPopoutIcon-1">
                    <i class="bx bx-filter-alt me-2"></i>
                    Show Filters
                </button>
            </h2>

            <div id="accordionPopoutIcon-1" class="accordion-collapse collapse" data-bs-parent="#accordionPopoutIcon">
                <div class="accordion-body">
                    <form action="{{ route('attendance-merged') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Select Employee:</label>
                                    <select class="form-select" name="employee_id" aria-label="Default select example">
                                        <option value="" {{ empty(request()->query('employee_id')) ? 'selected' : '' }}>All Employees</option>
                                        @foreach($employees as $employee)
                                        <option value="{{ $employee->employee_id }}" {{ request()->query('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                                            {{ $employee->last_name . ', ' . $employee->first_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Select Division:</label>
                                    <select class="form-select" name="division" aria-label="Default select example">
                                        <option value="" {{ empty(request()->query('division')) ? 'selected' : '' }}>All Divisions</option>
                                        <option value="OOGB" 
                                            {{ request()->query('division') == 'OOGB' ? 'selected' : '' }}>OOGB</option>
                                        <option value="OOED" 
                                            {{ request()->query('division') == 'OOED'? 'selected' : '' }}>OOED</option>
                                        <option value="AFMD" 
                                            {{ request()->query('division') == 'AFMD'? 'selected' : '' }}>AFMD</option>
                                        <option value="PIRD" 
                                            {{ request()->query('division') == 'PIRD'? 'selected' : '' }}>PIRD</option>
                                        <option value="READ"
                                            {{ request()->query('division') == 'READ'? 'selected' : '' }}>READ</option>
                                        <option value="CPDD" 
                                            {{ request()->query('division') == 'CPDD'? 'selected' : '' }}>CPDD</option>
                                        <option value="INDD" 
                                            {{ request()->query('division') == 'INDD'? 'selected' : '' }}>INDD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Select Personnel Type:</label>
                                    <select class="form-select" name="type" aria-label="Default select example">
                                        <option value="" {{ empty(request()->query('type')) ? 'selected' : '' }}>All Personnel Types</option>
                                        <option value="Plantilla" 
                                            {{ request()->query('type') == 'Plantilla' ? 'selected' : '' }}>Plantilla</option>
                                        <option value="COS/JO" 
                                            {{ request()->query('type') == 'COS/JO'? 'selected' : '' }}>COS/JO</option>
                                        <option value="Intern" 
                                            {{ request()->query('type') == 'Intern'? 'selected' : '' }}>Intern</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="date-inclusive" class="form-label">Date Inclusive:</label>
                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="date-inclusive" name="date_inclusive" value="{{ request()->query('date_inclusive') }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 float-end">
                                    @if(
                                        !empty(request()->query('employee_id')) ||  
                                        !empty(request()->query('division')) || 
                                        !empty(request()->query('type')) || 
                                        !empty(request()->query('date_inclusive'))
                                    )
                                        <a href="{{ route('attendance-merged') }}" class="btn btn-secondary">Reset</a>
                                    @endif
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="btn-group d-inline-block float-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Menu Actions</span>">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-height: 48px;">
            <i class="bx bx-menu me-1"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <h6 class="dropdown-header">Upload Attendance</h6>
            </li>
            <li><a class="dropdown-item" href="{{route('attendance-gforms-create')}}">
                <span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">
                    <i class='bx bxl-google bx-xs'></i>
                </span>Upload Google Form Responses (.xlsx)
            </a></li>
            <li><a class="dropdown-item" href="{{route('attendance-biometrics-create')}}">
                <span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">
                    <i class="bx bxs-watch bx-xs"></i>
                </span>Upload from Biometrics (.txt)
            </a></li>
            <!-- <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <h6 class="dropdown-header">View Raw Extract</h6>
            </li>
            <li>
                <a class="dropdown-item" href="{{route('attendance-gforms')}}">
                    <i class='bx bxl-google bx-xs me-2'></i>From Google Form
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{route('attendance-biometrics')}}">
                    <i class="bx bxs-watch bx-xs me-2"></i>From Biometrics
                </a>
            </li> -->
        </ul>
    </div>
</div>

<div class="card">
    <div class="table-responsive text-nowrap" style="min-height: 500px;">
        <table class="table">
            <thead>
                <tr>
                    <th class="fw-bolder">#</th>
                    <th class="fw-bolder">Date Entry</th>
                    <th class="fw-bolder">Emp ID</th>
                    <th class="fw-bolder">Employee</th>
                    <th class="fw-bolder">Type</th>
                    <th class="fw-bolder">Division</th>
                    <th class="fw-bolder">Time In</th>
                    <th class="fw-bolder">Time Out</th>
                    <th class="fw-bolder">Source</th>
                    <!-- <th class="text-center" title="Actions">
                        <i class="bx bx-menu"></i>
                    </th> -->
                </tr>
            </thead>
            <tbody>
                @forelse($time_entries as $time_entry)
                @php
                $iteration = ($loop->first) ? $loop->iteration + (($time_entries->currentPage() - 1) * $time_entries->perPage()) : $iteration + 1;
                @endphp
                <tr>
                    <th scope="row">{{ $iteration }}</th>
                    <td>{{ \Carbon\Carbon::parse($time_entry->date_entry)->format('M. d, Y') }}</td>
                    <td>{{ $time_entry->employee_id }}</td>
                    <td>
                        <div class="d-flex justify-content-left align-items-center">
                            <!-- <div class="avatar-wrapper">
                                <div class="avatar avatar-sm me-3">
                                    <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-user bx-xs"></i></span>
                                </div>
                            </div> -->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-body text-truncate">
                                    <span class="fw-semibold">{{ $time_entry->employee ? $time_entry->employee->last_name . ', ' . $time_entry->employee->first_name : '' }}</span>
                                </a>
                                <a href="{{ $time_entry->employee ? 'mailto:' . $time_entry->employee->email : '#' }}" target="_blank"><small class="text-muted">{{ $time_entry->employee ? $time_entry->employee->email : '' }}</small></a>
                            </div>
                        </div>
                    </td>
                    <td>{{ $time_entry->employee ? $time_entry->employee->personnel_type : '' }}</td>
                    <td>{{ $time_entry->employee ? $time_entry->employee->division : '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($time_entry->time_in)->format('h:i A') }}</td>
                    <td>{{ $time_entry->time_out ? \Carbon\Carbon::parse($time_entry->time_out)->format('h:i A') : '-' }}</td>
                    <td>
                        <span class="text-truncate d-flex align-items-center">
                            <span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">
                                @if($time_entry->source == 'Google Forms')
                                <i class="bx bxl-google bx-xs"></i>
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
                    <td colspan="9" class="text-center">No Records Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mx-3 mt-4">
        <div class="d-flex float-end">
            @if(count($time_entries))
            {{ $time_entries->links() }}
            @endif
        </div>
    </div>
</div>
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
