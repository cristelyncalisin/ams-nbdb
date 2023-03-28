<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;

class AttendanceService
{
    public function getAttendanceData(Request $request)
    {
        $time_entries = Attendance::select(
            'v_merged_attendance.date_entry',
            'v_merged_attendance.employee_id',
            'employees.last_name',
            'employees.first_name',
            'employees.email',
            'employees.division',
            'v_merged_attendance.time_in',
            'v_merged_attendance.time_out',
            'v_merged_attendance.source',

        )
        ->join('employees', 'v_merged_attendance.employee_id', 'employees.employee_id');
        
        if (!empty($request->employee_id)) {
            $time_entries = $time_entries->where(
                'v_merged_attendance.employee_id', $request->employee_id
            );
        }

        if (!empty($request->division)) {
            $time_entries = $time_entries->where(
                'employees.division', $request->division
            );
        }
        if (!empty($request->type)) {
            $time_entries = $time_entries->where(
                'employees.personnel_type', $request->type
            );
        }

        $date_inclusive = explode(" to ", $request->date_inclusive);
        if (!empty($request->date_inclusive)) {
            $time_entries = $time_entries->whereBetween('v_merged_attendance.date_entry', [
                $date_inclusive[0], $date_inclusive[1]
            ]);
        }

        $time_entries = $time_entries->orderByDesc('v_merged_attendance.date_entry')
            ->orderBy('employees.last_name')
            ->paginate(10)
            ->appends(request()->query());
            
        return $time_entries;
    }
}
