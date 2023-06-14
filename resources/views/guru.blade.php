@extends('app')

@section('content')

<div class="container-fluid">
    <div class="navbar navbar-expand-md navbar-light border-bottom">
        <div class="collapse navbar-collapse">
            <div class="container-fluid d-flex justify-content-between">
                <h1 class="navbar-brand">Jurnal Guru</h1>
                <ul class="nav">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </ul>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahJurnal">Tambah Jurnal</button>
        <div class="modal fade" id="tambahJurnal" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Guru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="form-group" action="{{ route('tambahJurnal') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                                                  
                                <div class="form-group mb-2">
                                    <input class="form-control d-none" type="text" name="idguru" value="{{ Auth::user()->guru()->idguru }}" readonly>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="nama">Nama</label>
                                    <input class="form-control" type="text" id="nama" name="nama" value="{{ Auth::user()->name }}" disabled>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="mapel">Mapel</label>
                                    <input class="form-control" type="text" id="mapel" name="mapel" value="{{ Auth::user()->mapel()->mapel }}" disabled>
                                </div>
                            	
                            <div class="form-group">
                                <label for="jam">Jam</label>
                                <input class="form-control" type="time" id="jam" name="jam" required>
                            </div>
                            <div class="form-group">
                                <label for="materi">Materi</label>
                                <input class="form-control" type="text" id="materi" name="materi" required>
                            </div>
                            <div class="form-group">
                                <label for="materi">Keterangan</label>
                                <input class="form-control" type="text" id="keterangan" name="keterangan">
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
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Guru</th>
                <th scope="col">Mata Pelajaran</th>
                <th scope="col">KD/CP</th>
                <th scope="col">Materi</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach ($jurnal as $j)
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $j->guru->nama }}</td>
                    <td>{{ $j->guru->mapel->mapel }}</td>
                    <td>{{ $j->jam }}</td>
                    <td>{{ $j->materi }}</td>
                    <td>{{ $j->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
