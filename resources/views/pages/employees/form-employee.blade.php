@php
    $faker = \Faker\Factory::create();

    $fake_first_name = $faker->unique()->firstName();
    $fake_last_name = $faker->unique()->lastName();
    $fake_username = strtolower($fake_first_name) . '.' . strtolower($fake_last_name);
@endphp

<div class="modal-body">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="text-center mb-4">
        @if ($employee->exists)
            <h3>Edit User Information</h3>
            <p>Update an exisiting employee information</p>
        @else
            <h3>Add Employee</h3>
            <p>Add a New Employee</p>
        @endif
        
    </div>
    <form id="employee-form" action="{{ $employee->exists ? route('employees-update', [$employee->employee_id]) : route('employees-store') }}" method="POST" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework">
        @csrf
        @if($employee->exists)
            @method('PUT')
        @endif
        <div class="col-12 fv-plugins-icon-container">
            <label class="form-label" for="employee_id">Employee ID</label>
            <input type="text" id="employee_id" name="employee_id" class="form-control" value="{{ $employee->employee_id }}" placeholder="eg: 123" required>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-12 col-md-4 fv-plugins-icon-container">
            <label class="form-label" for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $employee->first_name }}" placeholder="eg: {{ $fake_first_name }}" required>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-12 col-md-4 fv-plugins-icon-container">
            <label class="form-label" for="middle_name">Middle Name</label>
            <input type="text" id="middle_name" name="middle_name" class="form-control" value="{{ $employee->middle_name }}" placeholder="eg: {{ $faker->unique()->lastName() }}">
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-12 col-md-4 fv-plugins-icon-container">
            <label class="form-label" for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $employee->last_name }}" placeholder="eg: {{ $fake_last_name }}" required>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $employee->email }}" placeholder="eg: {{ $fake_username . '@books.gov.ph' }}" required>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label" for="position">Position</label>
            <input type="text" id="position" name="position" class="form-control" value="{{ $employee->position }}" placeholder="eg: Director">
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label" for="division">Division</label>
            <select id="division" name="division" class="form-select" aria-label="Default select example" required>
                <option selected disabled value>Division</option>
                <option value="BTTD" {{ $employee->division === 'BTTD' ? 'selected' : '' }}>BTTD</option>
                <option value="PRED" {{ $employee->division === 'PRED' ? 'selected' : '' }}>PRED</option>
                <option value="AFSD" {{ $employee->division === 'AFSD' ? 'selected' : '' }}>AFSD</option>
                <option value="CITD" {{ $employee->division === 'CITD' ? 'selected' : '' }}>CITD</option>
            </select>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label" for="personnel_type">Personnel Type</label>
            <select id="personnel_type" name="personnel_type" class="form-select" aria-label="Default select example" required>
                <option selected disabled value>Personnel Type</option>
                <option value="Plantilla" {{ $employee->personnel_type === 'Plantilla' ? 'selected' : '' }}>Plantilla</option>
                <option value="COS/JO" {{ $employee->personnel_type === 'COS/JO' ? 'selected' : '' }}>COS/JO</option>
                <option value="Intern" {{ $employee->personnel_type === 'Intern' ? 'selected' : '' }}>Intern</option>
            </select>
        </div>
        <div class="col-12 text-center">
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
        </div>
        <input type="hidden">
    </form>
</div>