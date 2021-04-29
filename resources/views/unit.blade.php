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
				<th>Nama Unit</th>
                <th>Keterangan</th>
				<th>Action</th>
			</tr>
			<tr>
				<td>1</td>
				<td>192206242040121001</td>
                <td>Keterangan</td>
				<th>
					<div class="btn-group">
						<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </div>
				</th>
			</tr>
			<tr>
			    <td>2</td>
				<td>192206242040121001</td>
                <td>Keterangan</td>
				<th>
					<div class="btn-group">
						<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </div>
				</th>
			</tr>
			<tr>
			    <td>3</td>
				<td>192206242040121001</td>
                <td>Keterangan</td>
				<th>
					<div class="btn-group">
						<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </div>
				</th>
			</tr>
			<tr>
			<td>4</td>
				<td>192206242040121001</td>
                <td>Keterangan</td>
				<td>
					<div class="btn-group">
						<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </div>
				</td>
			</tr>
			</table>
		</div>
		<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>
<!-- /.content -->

@endsection