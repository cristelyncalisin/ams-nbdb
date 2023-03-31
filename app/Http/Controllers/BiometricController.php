<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biometric;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class BiometricController extends Controller
{
    public function index()
    {
        $biometrics = Biometric::with('employee')->get();
        return view('pages.attendance.biometrics.biometrics-index', [
            'biometrics' => $biometrics
        ]);
    }

    public function create()
    {
        return view('pages.attendance.biometrics.form-biometrics-upload');
    }

    // public function store(Request $request)
    // {
    //     dd($request->file('file'));
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         $contents = file_get_contents($file->path());
    //         // Process the file contents here
    //         dd($contents);
    //     }
    // }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('biometrics/tmp/' . $folder, $filename);

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

        if (! $file) {
            return redirect()
                ->back()
                ->with('error', 'File does not exists!');
        }

        $fileContents = file_get_contents(
            storage_path('app/biometrics/tmp/' . $file->folder . '/' . $file->filename)
        );
        $lines = explode("\n", $fileContents);
        
        if (!str_starts_with($lines[0], 'No')) {
            return redirect()
                ->back()
                ->with('error', 'Invalid Biometrics Raw File!');
        }

        foreach ($lines as $line) {
            if (preg_match('/^(\d+)\t(\d+)\t(\d+)\t([^\t]+)\t(\d+)\t(\d+)\t(.+)$/', $line, $matches)) {
                $enNo = ltrim($matches[3], '0');
                $dateTime = $matches[7];

                $bio_check = Biometric::where([
                    'employee_id' => $enNo,
                    'timestamp' => $dateTime
                ])->first();
                
                if (!$bio_check) {
                    Biometric::create([
                        'employee_id' => $enNo,
                        'timestamp' => $dateTime
                    ]);
                }
            }
        }

        return redirect()->route('attendance-merged')->with(
            'success', 'Biometrics file successfully uploaded!'
        );
    }

}
