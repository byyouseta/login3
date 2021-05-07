@extends('layouts.app')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Daftar Pegawai')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Pegawai</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="/pegawai/tambahpegawai" method="post">
                {{ csrf_field() }}
                <!-- text input -->
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" placeholder="Masukkan NIP" name="username">
                        @if($errors->has('username'))
                            <div class="text-danger">
                                {{ $errors->first('username')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama" name="name">
                        @if($errors->has('name'))
                            <div class="text-danger">
                                {{ $errors->first('name')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="3" placeholder="Masukkan Alamat" name="alamat"></textarea>
                    </div>

                    <div class="form-group">
                        <label>No Handphone</label>
                        <input type="text" class="form-control" placeholder="Masukkan No Handphone" name="no_hp">
                        @if($errors->has('no_hp'))
                            <div class="text-danger">
                                {{ $errors->first('no_hp')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Masukkan Email" name="email">
                        @if($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Unit</label>
                        <select class="form-control" name="unit">
                            <option value="" selected>Pilih</option>
                            @foreach($unit as $u)
                                <option value="{{ $u->id}}">{{ $u->nama_unit}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('unit'))
                            <div class="text-danger">
                                {{ $errors->first('unit')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Hak Akses</label>
                        <select class="form-control" name="level">
                            <option value="" selected>Pilih</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        @if($errors->has('level'))
                            <div class="text-danger">
                                {{ $errors->first('level')}}
                            </div>
                        @endif
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="/pegawai" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </div>
    <!-- /.box-body -->
        </div>
        @if(!empty($pesan))
        <div class="alert alert-success alert-block">
		        <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $pesan }}</strong>
	    </div>
        @endif
    </div>
</div>
@endsection