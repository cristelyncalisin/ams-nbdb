<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;

class AttendanceController extends Controller
{
    public function index()
    {
        $time_entries = Attendance::with('employee')
            ->orderByDesc('date_entry')
            ->orderBy(
                Employee::select('last_name')
                    ->whereColumn(
                        'v_merged_attendance.employee_id', 
                        'employees.employee_id'
                    )
            )
            ->paginate(15);

        return view('pages.attendance.merged.attendance', [
            'time_entries' => $time_entries
        ]);
    }
}
