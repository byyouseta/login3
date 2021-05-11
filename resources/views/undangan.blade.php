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
        </div>
        <div class="box-header">
            <table class="table table-hover" style="width: 300px;">
                <tr><th>Nama Rapat</th><td>{{$agenda->nama_agenda}}</td></tr>
                <tr><th>Tanggal</th><td>{{$agenda->tanggal}}</td></tr>
                <tr><th>Waktu</th><td>{{$agenda->waktu_mulai .' - '. $agenda->waktu_selesai}}</td></tr>
                <tr><th>Tempat</th><td>{{$agenda->ruangan->nama}}</td></tr>
                <tr><th>PIC Rapat</th><td>{{$agenda->pic}}</td></tr>
                <tr><th>Keterangan</th><td>{{$agenda->keterangan}}</td></tr>
            </table>
            
        </div>
    </div> 
    <div class="box box-success">
        <div class="box-body">
            <form role="form" action="/undangan/tambahpeserta/{{ $id }}" method="post">
                {{ csrf_field() }}
                <div class="box-header table-hover">
                    <div class="form-group col-md-12">
                        <label>Tambah Peserta</label>
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
        </div>
    </div>
        <div class="box box-primary">
            <div class="box-header">
        <!-- /.box-header -->
                <h4> <label>Daftar Peserta </label></h4>
                    <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <?php
                $now = new DateTime();
                $now = $now->format('Y-m-d'); 
            ?>
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
                                <a href="/undangan/{{$id}}/hapus/{{ $user->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                            </div>
                        @endif
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
@endsection