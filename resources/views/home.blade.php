@extends('layouts.app')
@if (empty(Auth::user()->username))
        <script>window.location = "/login";</script>
@endif
<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Halaman Home')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

	<p>Ini Adalah Halaman Home</p>
	<p>Selamat datang !</p>
	Hallo {{Auth::user()->level}} {{Auth::user()->name}} </br>
	Email Anda : {{Auth::user()->email}} </br>
	Anda login dengan menggunakan username : {{Auth::user()->username}}
@endsection