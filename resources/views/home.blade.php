@extends('layouts.app')
@if (empty(Auth::user()->username))
        <script>window.location = "/login";</script>
@endif
<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Welcome Home')
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
	
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Selamat datang {{Auth::user()->level}} {{Auth::user()->name}}!</h4>
					Saat ini Anda login dengan menggunakan username : {{Auth::user()->username}} </br>
					Email Anda : {{Auth::user()->email}} </br>
					IP Address Anda : {{Request::ip()}} 
				</div>
			</div>
		</div>
	</div>	
</div>	
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-user-md"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Profile</span>
        <span class="info-box-number">{{Auth::user()->name}}<br></span>
  {{Auth::user()->username}}

      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Agenda Dijadwalkan</span>
        <span class="info-box-number">{{$agenda_terjadwal}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-calendar-plus-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Agenda Pengajuan</span>
        <span class="info-box-number">{{$agenda_diajukan}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Pegawai</span>
        <span class="info-box-number">{{$pegawai}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
@endsection