<!-- Menghubungkan dengan view template master -->
@extends('layouts.app')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Daftar Agenda')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

<div class="row">
	<div class="col-xs-12">
		<div class="box">
		<div class="box-header">
			<div class="btn-group">
				<a href="/agenda/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah</a>
			</div>

			<div class="box-tools">
			<div class="input-group input-group-sm" style="width: 150px;">
				<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

				<div class="input-group-btn">
				<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
				</div>
			</div>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover">
			<thead><tr>
				<th>No</th>
				<th>Nama Agenda</th>
				<th>Tanggal</th>
				<th>Waktu Mulai</th>
				<th>Waktu Selesai</th>
				<th>Tempat</th>
				<th>Status</th>
				<th>PIC</th>
				<th>Action</th>
			</tr></thead>
			<tbody>
				<?php $no=1; ?>
				@foreach($agenda as $a)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $a->nama_agenda }}</td>
					<td>{{ $a->tanggal }}</td>
					<td>{{ $a->waktu_mulai }}</td>
					<td>{{ $a->waktu_selesai }}</td>
					<td>{{ $a->ruangan->nama }}</td>
					<td>
						@if($a->status=="Scheduled")
							<span class="label label-success">{{$a->status}}</span>
						
						@else
							<span class="label label-warning">{{$a->status}}</span>
						
						@endif
					</td>
					<td>{{ $a->pic }}</td>
					<td>
					<div class="btn-group">
						<a href="/agenda/undangan/{{ $a->id }}" class="btn btn-success btn-sm"><i class="fa fa-info-circle"></i></a>
						<a href="/presensi/undangan/{{ $a->id }}" class="btn btn-primary btn-sm"><i class="fa fa-sign-in"></i></a>
						@if((Auth::user()->name==$a->pic) OR (Auth::user()->level=='admin'))
						<a href="/agenda/edit/{{ $a->id }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
						<a href="/agenda/hapus/{{ $a->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
						@endif
					</div>
					</td>
				</tr>
				@endforeach
			</tbody>
			
			</table>
		</div>
		<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection