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
                      <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah</button>
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
			<tr>
				<th>No</th>
				<th>Nama Agenda</th>
				<th>Tanggal</th>
				<th>Waktu</th>
				<th>Status</th>
				<th>Keterangan</th>
				<th>Action</th>
			</tr>
			<tr>
				<td>183</td>
				<td>John Doe</td>
				<td>11-7-2014</td>
				<td>11:00</td>
				<td><span class="label label-success">Agenda</span></td>
				<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
				<th>
					<div class="btn-group">
						<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </div>
				</th>
			</tr>
			<tr>
				<td>219</td>
				<td>Alexander Pierce</td>
				<td>11-7-2014</td>
				<td>07:00</td>
				<td><span class="label label-success">Agenda</span></td>
				<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
				<th>
					<div class="btn-group">
						<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </div>
				</th>
			</tr>
			<tr>
				<td>657</td>
				<td>Bob Doe</td>
				<td>11-7-2014</td>
				<td>11:00</td>
				<td><span class="label label-success">Agenda</span></td>
				<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
				<th>
					<div class="btn-group">
						<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </div>
				</th>
			</tr>
			<tr>
				<td>175</td>
				<td>Mike Doe</td>
				<td>11-7-2014</td>
				<td>11:00</td>
				<td><span class="label label-danger">Selesai</span></td>
				<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
				<th>
					<div class="btn-group">
						<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </div>
				</th>
			</tr>
			</table>
		</div>
		<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection