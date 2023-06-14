<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        $mapel  = Mapel::all();
        $guru   = Guru::all();
      	if($req->cari !== null){
        	$guru = Guru::where('nama','like',"%".$req->cari."%");
        }
        return view('admin', ['mapel' => $mapel, 'guru' => $guru]);
    }

    public function cari(Request $req)
    {
        $cari = $req->cari;
        
        $guru = Guru::where('nama','like',"%".$cari."%")->paginate(10);
        $mapel  = Mapel::all();
        
        return view('admin',['guru' => $guru, 'mapel' => $mapel]);
    }

    public function tambahGuru(Request $request)
    {
      	$this->validate($request, [
        	'nama' => 'required',
          	'email' => 'required',
          	'password' => 'required',
          	'mapel' => 'required',
        ]);
      
        User::create([
            'name'  => $request->nama,
            'email' => $request->email,
            'password'  => Hash::make($request->password),
            'role'  => 'Guru'
        ]);

        Guru::create([
            'nama'  => $request->nama,
            'idmapel'   => $request->mapel
        ]);

        return redirect()->back();
    }

    public function editGuru($idguru, Request $request)
    {
      	$this->validate($request, [
        	'nama' => 'required',
          	'mapel' => 'required',
        ]);
      
        $guru = Guru::find($idguru);
        $guru->nama = $request->nama;
        $guru->mapel = $request->mapel;
        $guru->save();

        return redirect()->back();
    }

    public function hapusGuru($idguru)
    {
        $guru = Guru::find($idguru);
        $guru->delete();

        return redirect()->back();
    }
}
