<div id="accordionPopoutIcon" class="accordion accordion-popout mb-4 flex-fill">
    <div class="accordion-item card">
        <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionPopoutIconOne">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionPopoutIcon-1" aria-controls="accordionPopoutIcon-1">
                <i class="bx bx-filter-alt me-2"></i>
                Show Filters
            </button>
        </h2>

        <div id="accordionPopoutIcon-1" class="accordion-collapse collapse" data-bs-parent="#accordionPopoutIcon">
            <div class="accordion-body">
                <form action="{{ route('attendance-dtr') }}" method="GET">
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
                                    <option value="BTTD" 
                                        {{ request()->query('division') == 'BTTD' ? 'selected' : '' }}>BTTD</option>
                                    <option value="PRED" 
                                        {{ request()->query('division') == 'PRED'? 'selected' : '' }}>PRED</option>
                                    <option value="AFSD" 
                                        {{ request()->query('division') == 'AFSD'? 'selected' : '' }}>AFSD</option>
                                    <option value="CITD" 
                                        {{ request()->query('division') == 'CITD'? 'selected' : '' }}>CITD</option>
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
                                    <a href="{{ route('attendance-dtr') }}" class="btn btn-secondary">Reset</a>
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