<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GForm;

class GFormController extends Controller
{
    public function index()
    {
        $gforms = GForm::with('employee')->get();
        return view('pages.attendance.gforms.gforms-index', [
            'gforms' => $gforms
        ]);
    }
}
