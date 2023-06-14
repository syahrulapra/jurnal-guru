@extends('app')

@section('content')

<div class="container-fluid">
    <div class="navbar navbar-expand-md navbar-light border-bottom">
        <div class="collapse navbar-collapse">
            <div class="container-fluid d-flex justify-content-between">
              	<div class="d-flex flex-row">
                  	<a href="{{ route('admin') }}" class="text-decoration-none"><h1 class="navbar-brand">Pengajar</h1></a>
             		<a class="nav-link" href="{{ route('mapel') }}">Daftar Mapel</a>
              	</div>
                <ul class="nav">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </ul>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahGuru">Tambah petugas</button>
        <div class="modal fade" id="tambahGuru" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="form-group" action="{{ route('tambahGuru') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="nama">Nama</label>
                                <input class="form-control" type="text" id="nama" name="nama">
                            </div>
                            <div class="form-group mb-2">
                                <label for="mapel">Mapel</label>
                                <select class="form-select" name="mapel" id="mapel">
                                    <option disabled selected>Pilih mapel</option>
                                    @foreach ($mapel as $m)
                                        <option value="{{ $m->idmapel }}">{{ $m->mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" id="password" name="password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <form method="GET" class="form-control border-0" style="width: 245px">
            <input class="border p-2 rounded" style="outline: none;" type="text" name="cari" placeholder="Cari" value="{{ old('cari') }}">
            <button class="border-0 bg-white">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
    <table class="table">
        <thead align="center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Guru</th>
                <th scope="col">Mata Pelajaran</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody align="center">
            @php
                $nomor = 1;
            @endphp
            @foreach ($guru as $g)    
            <tr>
                <td>{{ $nomor++ }}</td>
                <td>{{ $g->nama }}</td>
                <td>{{ $g->mapel->mapel }}</td>
                <td>
                    <button type="button"  class="btn btn-success" style="padding-inline: 22px" data-bs-toggle="modal" data-bs-target="#editGuru{{ $g->idguru }}">Edit</button>
                    |
                    <a class="btn btn-danger" href="{{ route('hapusGuru', $g->idguru) }}">Hapus</a>
                </td>
                <div class="modal fade" id="editGuru{{ $g->idguru }}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="form-group" action="{{ url('admin/guru/edit/' . $g->idguru . '/' . $g->user->id) }}" method="POST">
                                @csrf
                              	{{ method_field('PUT') }}
                                <div class="modal-body">
                                	<div class="form-group mb-2">
                                		<label for="nama">Nama</label>
                                		<input class="form-control" type="text" id="nama" name="nama" value="{{ $g->nama }}">
                                	</div>
                                	<div class="form-group mb-2">
                                		<label for="mapel">Mapel</label>
                                		<select class="form-select" name="mapel" id="mapel">
                                			<option selected value disabled="{{ $g->idmapel }}">{{ $g->mapel->mapel }}</option>
                                			@foreach ($mapel as $m)
                                				<option value="{{ $m->idmapel }}" @if($g->idmapel == $m->idmapel) selected @endif>{{ $m->mapel }}</option>                                                    
                                			@endforeach
                                		</select>
                                	</div>
                                	<div class="form-group">
                                		<label for="email">Email</label>
                                		<input class="form-control" type="email" id="email" name="email" value="{{ $g->user->email }}">
                                	</div>
                                	<div class="form-group">
                                		<label for="password">Password (Opsional)</label>
                                		<input class="form-control" type="password" id="password" name="password">
                                	</div>
                                </div>
                                <div class="modal-footer">
                                	<button type="submit" class="btn btn-primary"">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $guru->links() }}
</div>