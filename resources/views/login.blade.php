@extends('app')

@section('body')
<div class="vh-100 d-flex align-items-center justify-content-center">
    <div class="col-3 card p-4 shadow text-center d-flex align-items-center">
        <h3 class="text-dark">Jurnal Guru</h3>
        
        <form action="{{ route('loginaksi') }}" method="post" class="form-group mt-4 col-12">
            @csrf
            <input type="email" class="form-control" name="email" placeholder="Masukan Email" required autocomplete="off">
            <div class="m-3"></div>
            <input type="password" class="form-control" name="password" placeholder="Masukan Password" required autocomplete="off">
            <br>
            <input type="submit" value="Log In" class="form-control btn-primary">
            @if(session('error'))
            <p class="text-danger">{{ session('error') }}</p>
            @endif
        </form>
        <p class="small">Belum memiliki akun? 
            <a href="/signup">Sign Up</a>
        </p>
    </div>
</div>