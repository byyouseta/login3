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
			<a href="/unit/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah</a>
		</div>
			<div class="box-tools">
			<form action="/unit/cari" method="get">
				<div class="input-group input-group-sm" style="width: 150px;">
					<input type="text" name="cari" class="form-control pull-right" placeholder="Search"
					@if (Request::get('cari'))
						value="{{ Request::get('cari') }}"
					@endif
					>
					<div class="input-group-btn">
					<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
			</div>
		</div>
		@php
			if (isset($cari)) {
				# code...
				$no = 1;
			}
			else {
				$halaman = $unit->currentPage();
				$per_page = $unit->perPage();
				$no= (($halaman-1)*$per_page) + 1;
			}
				
			$now = new DateTime();
			$now = $now->format('Y-m-d'); 
		@endphp
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Unit</th>
						<th>Keterangan</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($cari))
						@foreach($cari as $u)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $u->nama_unit }}</td>
								<td>{{ $u->keterangan }}</td>
								<td>
								<div class="btn-group">
									<a href="/unit/edit/{{ Crypt::encrypt($u->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ubah">
									<i class="fa fa-edit"></i></a>
									<a href="/unit/hapus/{{ Crypt::encrypt($u->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Hapus">
									<i class="fa fa-trash-o"></i></a>
								</div>
								</td>
							</tr>
						@endforeach
					@else
						@foreach($unit as $u)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $u->nama_unit }}</td>
								<td>{{ $u->keterangan }}</td>
								<td>
								<div class="btn-group">
									<a href="/unit/edit/{{ Crypt::encrypt($u->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ubah">
									<i class="fa fa-edit"></i></a>
									<a href="/unit/hapus/{{ Crypt::encrypt($u->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Hapus">
									<i class="fa fa-trash-o"></i></a>
								</div>
								</td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
		</div>
		
		<!-- /.box -->
	</div>
	<div class="box-footer clearfix">	
		<ul class="pagination pagination-sm no-margin pull-right">
		
		<li>
			@if(!empty($cari))
				{{ $cari->appends(Request::get('page'))->links()}}	
			@else
				{{ $unit->appends(Request::get('page'))->links()}}
			@endif
		</li>
		
		</ul>
	</div>
</div>
<!-- /.content -->

@endsection