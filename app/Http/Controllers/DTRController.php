<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Services\AttendanceService;

class DTRController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::select(
            'employee_id', 'last_name', 'first_name'
        )->get();
        
        $dtr_details = (new AttendanceService())->getGroupedAttendanceData($request);
        
        if (
            !empty($request->query('division')) && 
            !empty($request->query('date_inclusive'))
        ) {
            return view('pages.attendance.dtr.dtr-index', [
                'dtr_details' => $dtr_details,
                'employees' => $employees
            ]);
        }

        return view('pages.attendance.dtr.dtr-index', [
            'dtr_details' => [],
            'employees' => $employees
        ]);

    }

    public function print(Request $request)
    {
        if ((!$request->date_inclusive) && (!$request->division)) {
            return redirect()
                ->route('attendance-dtr')
                ->with('error', 'Please select a Division and Date Inclusive!');
        }
        if (! $request->date_inclusive) {
            return redirect()
                ->route('attendance-dtr')
                ->with('error', 'Please select a Date Inclusive!');
        }
        if (! $request->division) {
            return redirect()
                ->route('attendance-dtr')
                ->with('error', 'Please select a Division!');
        }

        return (new AttendanceService())->printDTR($request);
    }
}
