<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use App\Http\Services\AttendanceService;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $time_entries = (new AttendanceService())->getAttendanceData($request);

        $employees = Employee::select(
            'employee_id', 'last_name', 'first_name'
        )->get();

        return view('pages.attendance.merged.attendance', [
            'time_entries' => $time_entries,
            'employees' => $employees
        ]);
    }
}
