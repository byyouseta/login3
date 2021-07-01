<!-- Menghubungkan dengan view template master -->
@extends('layouts.app')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Daftar Hadir')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

<div class="row">
    
	<div class="col-xs-12">
        
        
       
		<div class="box">
            
		<div class="box-header">
            <table class="table table-borderless" >
                <thead>
                    <tr>
                        <th><img src="{{asset('adminlte/dist/img/LogoKemenkes.png')}}" alt="Logo Kemenkes" width="100" ></th>
                        <th class="text-center">
                            <h2>DIREKTORAL JENDERAL PELAYANAN KESEHATAN<h2>
                            <h3>RUMAH SAKIT UMUM PUSAT SURAKARTA</h3>
                            Jl.Prof.Dr.R.Soeharso No.28 Surakarta Telp. Fax. 0271-713055
                        </th><th><img src="{{asset('adminlte/dist/img/Logo.png')}}" alt="Logo RSUP" width="100"></th>
                    </tr>
                </thead>
            </table>
            <?php 
                $arrhari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
                $hari = new DateTime($agenda->tanggal);
                //$hari = $arrhari[$tanggal->format('N')];
                $tanggal = new DateTime($agenda->tanggal);
            ?>
            <div class="progress progress-xs">
                <div class="progress-bar progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    <span class="sr-only">60% Complete (warning)</span>
                </div>
            </div>
            <table class="table table-borderless" >
                <tbody>
                    <tr><th colspan='4' class="text-center"><h2>DAFTAR HADIR</h2></th></tr>
                <tr>
                    <th class="col-xs-1">Hari</th><td>{{$arrhari[$tanggal->format('N')]}}</td>
                    <th class="text-right ">Tempat</th><td class="col-xs-4">{{$agenda->ruangan->nama}}</td>
                </tr>
                <tr>
                    <th >Tanggal</th><td >{{$tanggal->format('d-m-Y')}}</td>
                    <th class="text-right">Acara</th><td>{{$agenda->nama_agenda}}</td>
                </tr>
                </tbody>
            </table>
           
  
        </div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
			<table class="table table-bordered">
			<thead><tr>
				<th>No</th>
				<th class="col-xs-5">Nama </th>
				<th class="col-xs-4">Instansi</th>
				<th class="col-xs-2">Waktu Presensi</th>				
			</tr></thead>
			<tbody>
				<?php $no=1; ?>
				
					@foreach($peserta as $user)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->unit->nama_unit }}</td>
						<td>{{ $user->pivot->presensi_at }}</td>
					</tr>
					@endforeach
                    @foreach($tamu as $t)
                    <tr>
						<td>{{ $no++ }}</td>
						<td>{{ $t->nama }}</td>
						<td>{{ $t->unit }}</td>
						<td>{{ $t->created_at }}</td>
					</tr>
                    @endforeach
			</tbody>
			</table>
            
		</div>
		<!-- /.box-body -->
		
		</div>
		<!-- /.box -->
        <a href="/presensi/hadir_pdf/{{ Crypt::encrypt($agenda->id) }}" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> CETAK PDF</a>
	</div>
</div>
<!-- /.content -->

@endsection