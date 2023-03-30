<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('pages.employees.employees-index', [ 'employees' => $employees ]);
    }

    public function create()
    {
        $employee = new Employee();

        return view('pages.employees.form-employee', [
            'employee' => $employee
        ]);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();

        $employee = Employee::create($data);

        return redirect()->back()
            ->with('success', 'Employee successfully added!');
    }

    public function edit($employee_id)
    {
        $employee = Employee::where('employee_id', $employee_id)->first();

        return view('pages.employees.form-employee', [
            'employee' => $employee
        ]);
    }

    public function update($employee_id, UpdateEmployeeRequest $request)
    {
        $data = $request->validated();

        $employee = Employee::where('employee_id', $employee_id)->update($data);

        return redirect()->back()
            ->with('success', 'Employee successfully updated!');
    }
}
