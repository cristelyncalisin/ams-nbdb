<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\GForm;
use App\Models\TemporaryFile;
use Spatie\SimpleExcel\SimpleExcelReader;

class GFormController extends Controller
{
    public function index()
    {
        $gforms = GForm::with('employee')->get();
        return view('pages.attendance.gforms.gforms-index', [
            'gforms' => $gforms
        ]);
    }

    public function create()
    {
        return view('pages.attendance.gforms.form-gforms-upload');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('gforms/tmp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }

        return '';
    }

    public function store(Request $request)
    {
        $file = TemporaryFile::where('folder', $request->file)->first();

        if (!$file) {
            return redirect()
                ->back()
                ->with('error', 'File does not exists!');
        }

        $path = storage_path('app/gforms/tmp/' . $file->folder . '/' . $file->filename);
        $reader = SimpleExcelReader::create($path)->fromSheet(1);
        
        if ($reader->getHeaders()[0] !== "Timestamp") {
            return redirect()
                ->back()
                ->with('error', 'Invalid Google Form Response!');
        }

        $reader->getRows()->each(function (array $rowProperties) {
            // dd($rowProperties);
            $email = trim($rowProperties['Email Address']);
            $timestamp = trim($rowProperties['Timestamp']->format('Y-m-d H:i:s'));
            
            $employee_id = $rowProperties['Plantilla ID No. (SKIP this part if \"Not Applicable\")'] ?? $rowProperties['Job Order/COS ID No. (SKIP this part if \"Not Applicable\")'];
            $employee = Employee::where('employee_id', $employee_id)->first();

            if ($employee) {
                $gform_check = GForm::where([
                    'employee_id' => $employee->employee_id,
                    'timestamp' => $timestamp
                ])->first();

                if (!$gform_check) {
                    GForm::create([
                        'employee_id' => $employee->employee_id,
                        'timestamp' => $timestamp
                    ]);
                }
            }
        });

        return redirect()->route('attendance-merged')->with(
            'success',
            'Google Forms Responses file successfully uploaded!'
        );
    }
}
