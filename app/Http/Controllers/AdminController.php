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
        $guru   = Guru::paginate(10);
      	if($req->cari !== null){
        	$guru = Guru::where('nama','like',"%".$req->cari."%")->paginate(10);
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

    public function editGuru($idguru, $iduser, Request $request)
    {
      	$this->validate($request, [
        	'nama' => 'required',
          	'email' => 'required',
          	'mapel' => 'required',
        ]);
      
        $guru = Guru::find($idguru);
      	$user = User::find($iduser);
        $guru->nama = $request->nama;
      	$user->name = $request->nama;
     	$user->email = $request->email;
      	$guru->idmapel = $request->mapel;
      	if($request->password !== null){
        	$guru->user->password = Hash::make($request->password); 
        }
        $guru->save();
      	$user->save();

        return redirect()->back();
    }
  
  	public function hapusGuru($id){
		$guru = Guru::find($id);
      	$user = User::where('name', $guru->nama);
      	$user->delete();
      	$guru->delete();
      
      	return redirect()->back();
    }
}
