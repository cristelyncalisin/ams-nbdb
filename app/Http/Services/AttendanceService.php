<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function getGroupedAttendanceData(Request $request)
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
            \DB::raw("
                IF(
                    TIMEDIFF(
                        IF(
                            v_merged_attendance.time_in > '13:00:00', 
                            SUBTIME(v_merged_attendance.time_in, '01:00:00'), 
                            v_merged_attendance.time_in
                        ), 
                        '08:00:00'
                    ) > 0, 
                    TIME_FORMAT(
                        TIMEDIFF(
                            IF(
                                v_merged_attendance.time_in > '13:00:00',
                                SUBTIME(v_merged_attendance.time_in, '01:00:00'),
                                v_merged_attendance.time_in
                            ), 
                            '08:00:00'
                        ),
                        '%H:%i'
                    ), 
                    0
                ) AS late
            "),
            \DB::raw("
                IF(
                    TIMEDIFF(
                        '17:00:00', 
                        IF(
                            v_merged_attendance.time_out < '13:00:00', 
                            ADDTIME(v_merged_attendance.time_out, '01:00:00'),
                            v_merged_attendance.time_out
                        )
                    ) > 0,
                    TIME_FORMAT(
                        TIMEDIFF(
                            '17:00:00', 
                            IF(
                                v_merged_attendance.time_out < '13:00:00', 
                                ADDTIME(v_merged_attendance.time_out, '01:00:00'),
                                v_merged_attendance.time_out
                            )
                        ),
                        '%H:%i'
                    )
                    , 0
                ) AS undertime
            "),
            'v_merged_attendance.source'
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

        $time_entries = $time_entries->orderBy('employees.last_name')
            ->orderBy('v_merged_attendance.date_entry')
            ->get()
            ->groupBy('employee_id');

        $data = $time_entries->map(function ($group) {
            $totalLate = $group->sum(function ($entry) {
                $durationParts = explode(':', $entry->late);
                $hours = (int)($durationParts[0] ?? 0);
                $minutes = (int)($durationParts[1] ?? 0);
                return $hours * 60 + $minutes;
            });
            $totalUndertime = $group->sum(function ($entry) {
                $durationParts = explode(':', $entry->undertime);
                $hours = (int)($durationParts[0] ?? 0);
                $minutes = (int)($durationParts[1] ?? 0);
                return $hours * 60 + $minutes;
            });

            return [
                'employee_id' => $group->first()['employee_id'],
                'last_name' => $group->first()['last_name'],
                'first_name' => $group->first()['first_name'],
                'email' => $group->first()['email'],
                'division' => $group->first()['division'],
                'total_late' => $totalLate == 0 ? '' : sprintf('%02d:%02d', (int)($totalLate / 60), $totalLate % 60),
                'total_ut' => $totalUndertime == 0 ? '' : sprintf('%02d:%02d', (int)($totalUndertime / 60), $totalUndertime % 60),
                'data' => $group
            ];
        });

        // dd($data);
            
        return $data;
    }

    public function printDTR(Request $request) {
        $data = $this->getGroupedAttendanceData($request);
        $pdf = Pdf::loadView('pages.attendance.dtr.print-dtr', [ 'dtr_details' => $data ]); 
        $pdf->set_option('isHtml5ParserEnabled', true);       
        return $pdf->stream();
    }
}
