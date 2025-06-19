<?php

namespace App\Http\Controllers\Web\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $absensis = Absensi::all();
        return view('absensi.absensi.index', compact('absensis'));
    }
}
