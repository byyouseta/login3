<!-- Menghubungkan dengan view template master -->
@extends('layouts.app')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Daftar Pegawai')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

<div class="row">
	<div class="col-xs-12">
		<div class="box">
		<div class="box-header">
		<div class="btn-group">
                      <a href="/pegawai/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah</a>
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
				<th>NIP</th>
				<th>Nama Pegawai</th>
				<th>Alamat</th>
				<th>Unit</th>
				<th>No Handphone</th>
				<th>Action</th>
			</tr></thead>
			<tbody>
				<?php $no=1; ?>
				@foreach($pegawai as $p)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $p->username }}</td>
					<td>{{ $p->name }}</td>
					<td>{{ $p->pegawai->alamat }}</td>
					<td>{{ $p->unit->nama_unit }}</td>
					<td>{{ $p->pegawai->no_hp }}</td>
					<td>
					<div class="btn-group">
						<a href="/pegawai/edit/{{ Crypt::encrypt($p->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ubah">
						<i class="fa fa-edit"></i></a>
						<a href="/pegawai/hapus/{{ Crypt::encrypt($p->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Hapus">
						<i class="fa fa-trash-o"></i></a>
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
<!-- /.content -->

@endsection