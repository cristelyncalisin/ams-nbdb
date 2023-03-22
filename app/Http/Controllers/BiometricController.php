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
}
