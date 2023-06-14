<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\GuruContoller;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect('login');
});

Route::middleware(['guest'])->group(function() {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('loginaksi'); 
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::middleware(['role:Admin'])->group(function() {
        Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin');
      
        Route::post('admin/guru/tambah', [AdminController::class, 'tambahGuru'])->name('tambahGuru');
        Route::put('admin/guru/edit/{idguru}/{iduser}', [AdminController::class, 'editGuru'])->name('editGuru');
        Route::get('admin/guru/hapus/{id}', [AdminController::class, 'hapusGuru'])->name('hapusGuru');
      
      	Route::get('admin/mapel', [MapelController::class, 'index'])->name('mapel');
      	Route::post('admin/mapel/tambah', [MapelController::class, 'tambah'])->name('tambahMapel');
      	Route::put('admin/mapel/edit/{id}', [MapelController::class, 'edit'])->name('editMapel');
      	Route::get('admin/mapel/hapus/{id}', [MapelController::class, 'hapus'])->name('hapusMapel');
    });

    Route::middleware(['role:Guru'])->group(function() {
        Route::get('guru/dashboard', [GuruContoller::class, 'index'])->name('guru');
		Route::get('guru/test', function(){
        	 return response()->json(['message' => Auth::user()->guru(),]);
        });
      	Route::post('guru/tambah', [GuruContoller::class, 'tambahJurnal'])->name('tambahJurnal');
    });
});