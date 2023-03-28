<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Services\AttendanceService;

class DTRController extends Controller
{
    public function index(Request $request)
    {
        $time_entries = (new AttendanceService())
            ->getAttendanceData($request, 'v_merged_attendance.employee_id', 'desc');

        $employees = Employee::select(
            'employee_id', 'last_name', 'first_name'
        )->get();

        return view('pages.attendance.dtr.dtr-index', [
            'time_entries' => $time_entries,
            'employees' => $employees
        ]);
    }
}
