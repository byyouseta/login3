@extends('layouts.app')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Agenda')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header">
            <a href="/agenda" class="btn btn-warning">Kembali</a>
            @if($agenda->status == 'Pengajuan')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Verifikasi</button>
            @endif
        </div>
        
        
        <div class="box-header">
            <table class="table table-hover" >
                <tr>
                    <th>Nama Rapat</th><td>{{$agenda->nama_agenda}}</td>
                    <th>PIC Rapat</th><td>{{$agenda->pic}}</td>
                </tr>
                <tr>
                    <th>Tanggal</th><td>{{$agenda->tanggal}}</td>
                    <th>Jumlah Peserta</th><td>{{$agenda->user->count()}}</td>
                </tr>
                <tr>
                    <th>Waktu</th><td>{{$agenda->waktu_mulai .' - '. $agenda->waktu_selesai}}</td>
                    <th>Peserta Presensi</th><td>{{$presensi}}</td>
                </tr>
                <tr>
                    <th>Tempat</th><td>{{$agenda->ruangan->nama}}</td>
                    <th>Notulen</th><td>
                    @if (!empty($agenda->notulen))
                    {{$agenda->notulen}} 
                    <a href="/notulen/view/{{ $agenda->notulen }} " target="_blank" class="label label-success">Lihat File</a>
                    @else
                    <span class="label label-warning">belum ada Notulen</span>
                    @endif
                    </td>
                </tr>
                
                <tr><th>Keterangan</th><td>{{$agenda->keterangan}}</td>
                    <th>Daftar Hadir</th><td>
                    @if (!empty($agenda->daftar))
                    {{$agenda->daftar}} 
                    <a href="/daftarhadir/view/{{ $agenda->daftar }} " target="_blank" class="label label-success">Lihat File</a>
                    @else
                    <span class="label label-warning">belum ada Daftar Hadir</span>
                    @endif
                    </td></tr>
                <tr><th>Status</th><td>
                    @if($agenda->status == 'Pengajuan' )
                        <span class="label label-warning">
                    @elseif($agenda->status == 'Dijadwalkan')
                        <span class="label label-success">
                    @else
                        <span class="label label-primary">
                    @endif
                    {{$agenda->status}}</span>
                    </td></tr>
                
            </table>
            
        </div>
    </div> 
    <?php 
        $no=1; 
        $now = new DateTime();
        $now = $now->format('Y-m-d'); 
    ?>
    @if(($agenda->status <> 'Pengajuan') AND (Auth::user()->name==$agenda->pic))
    <div class="box box-success">
        <div class="box-body">
            @if(($now <= $agenda->tanggal) AND (Auth::user()->level=='admin'))
                <form role="form" action="/undangan/tambahpeserta/{{ $id }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-header table-hover">
                        <div class="form-group col-md-12">
                            <label>Daftar Peserta Rapat</label>
                        </div>
                    <div class="form-group col-md-8">
                        <input type="hidden" name="id" value="{{$id}}">
                        <select class="form-control select2 " style="width: 100%;" name="peserta">
                        <option selected value="" active>Pilih</option>
                            @foreach($pegawai as $p)
                                <option value="{{ $p->id}}">{{ $p->name ." Unit ". $p->unit->nama_unit}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah</button>
                    </div>
                    <div class="col-md-12">
                        @if($errors->any())
                            <div class="text-danger">
                                {{ $errors->first()}}
                            </div>
                        @endif
                    </div>
                </form>
            @endif
            @if(($now >= $agenda->tanggal) AND (empty($agenda->notulen)))
                <form class="form-inline" action="/notulen/upload/{{ $id }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group col-md-8">
						<strong>File Notulen dalam bentuk PDF (Maksimal 2Mb)</strong>
						<input type="file" name="filepdf">
                        
					</div>
 
					<div class="form-group col-md-2">
					    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-upload"> Upload</i></button>
                    </div>
				</form>
            @endif
                @if($errors->has('filepdf'))
                    <div class="text-danger">
                        {{ $errors->first('filepdf')}}
                    </div>
                @endif
            @if(($now >= $agenda->tanggal) AND (empty($agenda->daftar)))
                <form action="/daftarhadir/upload/{{ $id }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
 
					<div class="form-group col-md-8">
						<strong>File Daftar Hadir dalam bentuk PDF/JPEG (Maksimal 2Mb)</strong>
						<input type="file" name="filedaftar">
                        
					</div>
 
					<div class="form-group col-md-2">
					    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-upload"> Upload</i></button>
                    </div>
				</form>
            @endif
                @if($errors->has('filedaftar'))
                    <div class="text-danger">
                        {{ $errors->first('filedaftar')}}
                    </div>
                @endif
        </div>
    </div>
    @endif 
    <div class="box box-primary">
        <div class="box-header">
        <!-- /.box-header -->
            <h4> <label>Daftar Peserta </label></h4>
            <div class="box-tools">
                <form action="/undangan/cari/{{Crypt::encrypt($agenda->id)}}" method="get">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="cari" class="form-control pull-right" placeholder="Search">
                        
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
     
    <div class="box-body">
        <div class="box-body table-responsive no-padding">
            <?php $no=1; ?>
            <table class="table table-hover">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Unit</th>
                <th>Status Presensi</th>
                <th>Waktu Presensi</th>
                <th>Action</th>
            </tr>
            @if(!empty($cari))
                @foreach($cari as $user)
                <tr>
                    <td>{{ $no++}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->nama_unit}}</td>
                    <td>@if($user->presensi=='sudah')
                        <span class="label label-success">
                    @else
                        <span class="label label-danger">
                    @endif
                        {{$user->presensi}}</span></td>
                    <td>{{$user->presensi_at}}</td>
                @endforeach
            @else
                @foreach($agenda->user as $user)
                    <tr>
                    <td>{{ $no++}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->unit->nama_unit}}</td>
                    <td>
                    @if($user->pivot->presensi=='sudah')
                        <span class="label label-success">
                    @else
                        <span class="label label-danger">
                    @endif
                        {{$user->pivot->presensi}}</span></td>
                    <td>{{$user->pivot->presensi_at}}</td>
                    <td>
                    @if($now < $agenda->tanggal)
                        <div class="btn-group">
                            <a href="/undangan/{{$id}}/hapus/{{ Crypt::encrypt($user->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                        </div>
                    @else
                        <div class="btn-group">
                            <a href="/undangan/{{$id}}/hapus/{{ Crypt::encrypt($user->id) }}" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash-o"></i></a>
                        </div>
                    @endif
                    </td>
                    </tr>
                @endforeach
            @endif
            </table>
        </div>
        
    <!-- /.box-body -->
    </div>
        
        <!-- /.box -->
    </div>
    
    <!--modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Verifikasi Agenda</h4>
            </div>
            <div class="modal-body">
            <form method="post" action="/agenda/verifikasi">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Diverifikasi Oleh</label>
                        <input type='hidden' class="form-control" name='id' value='{{$agenda->id}}' />
                        <input type='text' class="form-control" name='verifikator' value='{{Auth::user()->name}}' disabled/>
                    </div>
                
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" rows="3" name='catatan' placeholder="Catatan"></textarea>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
@endsection