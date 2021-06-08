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
					
					<a href="/agenda/tambah" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Tambah Agenda">
					<i class="fa fa-plus-circle"></i> Tambah</a>
					
					
				</div>
				
				<div class="box-tools">
					<form action="/agenda/cari" method="get">
						
						<div class="input-group input-group-sm" style="width: 150px;">
							<input type="text" name="cari" class="form-control pull-right" placeholder="Search">

							<div class="input-group-btn">
								<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</form>
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
					<!--<th>Jumlah Peserta</th>-->
					<th>PIC</th>
					<th>Diajukan</th>
					<th style="width: 150px;"> Action</th>
				</tr></thead>
				<tbody>
					<?php 
						if(isset($cari)){
							$halaman = $agenda->currentPage();
							$per_page = $agenda->perPage();
							$no= (($halaman-1)*$per_page) + 1;
						}
						else{
							$no = 1;
						} 
						$now = new DateTime();
						$now = $now->format('Y-m-d'); 
					?>
					@foreach($agenda as $a)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $a->nama_agenda }}</td>
						<td>{{ $a->tanggal }}</td>
						<td>{{ $a->waktu_mulai }}</td>
						<td>{{ $a->waktu_selesai }}</td>
						<td>{{ $a->nama_ruangan }}</td>
						<td>
							@if($a->status=="Dijadwalkan")
								<span class="label label-success">{{$a->status}}</span>
							
							@elseif($a->status=="Pengajuan")
								<span class="label label-warning">{{$a->status}}</span>
							@else
								<span class="label label-primary">{{$a->status}}</span>
							@endif
						</td>
						<!--<td></td>-->
						<td>{{ $a->pic }}</td>
						<td>{{ $a->created_at }}</td>
						<td>
						<div class="btn-group">
							<a href="/agenda/undangan/{{ Crypt::encrypt($a->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Detail">
								<i class="fa fa-info-circle"></i></a>
							<a href="/presensi/undangan/{{ Crypt::encrypt($a->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Presensi">
								<i class="fa fa-sign-in"></i></a>
							@if((Auth::user()->name==$a->pic) OR (Auth::user()->level=='admin'))
								@if($now < $a->tanggal) 
								<a href="/agenda/edit/{{ Crypt::encrypt($a->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ubah">
									<i class="fa fa-edit"></i></a>
								<a href="/agenda/hapus/{{ Crypt::encrypt($a->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Hapus">
									<i class="fa fa-trash-o"></i></a>
								@else
								<a href="/agenda/edit/{{ Crypt::encrypt($a->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ubah" disabled>
									<i class="fa fa-edit"></i></a>
								<a href="/agenda/hapus/{{ Crypt::encrypt($a->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Hapus" disabled>
									<i class="fa fa-trash-o"></i></a>
								@endif
							@endif
						</div>
						</td>
					</tr>
					@endforeach
				</tbody>
				
				</table>
				<!-- /.box-body -->
			</div>
			
			<div class="box-footer clearfix">
				
              <ul class="pagination pagination-sm no-margin pull-right">
               
                <li>
				
					{{ $agenda->appends(Request::get('page'))->links()}} 
				
				</li>
                
              </ul>
            </div>
			
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection