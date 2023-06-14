<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MapelController extends Controller
{
    public function index(Request $req)
    {
        $mapel  = Mapel::all();
        return view('mapel', ['mapel' => $mapel]);
    }
	
  	public function tambah(Request $req){
      	$this->validate($req, [
        	'mapel' => 'required',
        ]);
    	Mapel::create([
        	'mapel' => $req->mapel,
        ]);
      
      	return redirect()->back();
    }
  
  	public function edit($id, Request $req){
      	$this->validate($req, [
        	'mapel' => 'required',
        ]);
    	$mapel = Mapel::find($id);
      	$mapel->mapel = $req->mapel;
      	$mapel->save();
      
      	return redirect()->back();
    }
  
  	public function hapus($id){
    	$mapel = Mapel::find($id);
		$mapel->delete();
      
      	return redirect()->back();
    }
}