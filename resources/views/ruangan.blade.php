<!-- Menghubungkan dengan view template master -->
@extends('layouts.app')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Daftar Unit')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

<div class="row">
	<div class="col-xs-12">
		<div class="box">
		<div class="box-header">
		<div class="btn-group">
			<a href="/ruangan/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah</a>
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
			<?php $no=1; ?>
				
			<tr>
				<th>No</th>
				<th>Nama Ruangan</th>
				<th>Lokasi</th>
                <th>Keterangan</th>
				<th>Action</th>
			</tr>
			@foreach($ruangan as $r)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $r->nama }}</td>
					<td>{{ $r->lokasi }}</td>
					<td>{{ $r->keterangan }}</td>
					<td>
						<div class="btn-group">
							<a href="/ruangan/edit/{{ $r->id }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
							<a href="/ruangan/hapus/{{ $r->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
						</div>
					</td>
				</tr>
			@endforeach
			</table>
		</div>
		<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>
<!-- /.content -->

@endsection