<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biometric;

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

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $contents = file_get_contents($file->path());
            // Process the file contents here
            dd($contents);
        }
    }
}
