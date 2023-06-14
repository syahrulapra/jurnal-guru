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
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahMapel">Tambah mapel</button>
        <div class="modal fade" id="tambahMapel" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="form-group" action="{{ route('tambahMapel') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="mapel">Mapel</label>
                                <input class="form-control" type="text" id="mapel" name="mapel">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead align="center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Mapel</th>
				<th></th>
            </tr>
        </thead>
        <tbody align="center">
            @php
                $nomor = 1;
            @endphp
            @foreach ($mapel as $g)    
            <tr>
                <td>{{ $nomor++ }}</td>
                <td>{{ $g->mapel }}</td>
                <td>
                    <button type="button"  class="btn btn-success" style="padding-inline: 22px" data-bs-toggle="modal" data-bs-target="#editMapel{{ $g->idmapel }}">Edit</button>
                    |
                    <a class="btn btn-danger" href="{{ route('hapusMapel', $g->idmapel) }}">Hapus</a>
                </td>
                <div class="modal fade" id="editMapel{{ $g->idmapel }}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="form-group" action="{{ route('editMapel', $g->idmapel) }}" method="POST">
                                @csrf
                            	{{ method_field('PUT') }}
                                <div class="modal-body">
                                	<div class="form-group mb-2">
                                		<label for="mapeledit">Mapel</label>
                                		<input class="form-control" type="text" id="mapeledit" name="mapel" value="{{ $g->mapel }}">
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
</div>
