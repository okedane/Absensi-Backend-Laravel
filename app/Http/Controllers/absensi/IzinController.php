<?php

namespace App\Http\Controllers\absensi;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function index()
    {
        $izins = Izin::orderBy('created_at', 'asc')->get();
        return view('absensi.izin.index', compact('izins'));
    }
}
