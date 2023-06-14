<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jurnal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuruContoller extends Controller
{
    public function index()
    {
        $jurnal = Jurnal::all();
        $guru   = Guru::all();
        return view('guru', ['jurnal' => $jurnal, 'guru' => $guru]);
    }

    public function tambahJurnal(Request $request)
    {
        Jurnal::create([
            'idguru'    => $request->idguru,
            'jam'       => $request->jam,
            'materi'        => $request->materi,
            'keterangan'    => $request->keterangan,
            'created_at'    => Carbon::now(),
        ]);

        return redirect()->back();
    }
}
