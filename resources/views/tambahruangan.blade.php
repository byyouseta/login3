@extends('layouts.app')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Daftar Ruangan')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Ruangan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="/ruangan/tambahruangan" method="post">
                {{ csrf_field() }}
                <!-- text input -->
                    <div class="form-group">
                        <label>Nama Ruangan</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama Ruangan" name="nama" value="{{ old('nama') }}">
                        @if($errors->has('nama'))
                            <div class="text-danger">
                                {{ $errors->first('nama')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" class="form-control" placeholder="Masukkan Lokasi Ruangan" name="lokasi" value="{{ old('lokasi') }}">
                        @if($errors->has('lokasi'))
                            <div class="text-danger">
                                {{ $errors->first('lokasi')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" rows="3" placeholder="Masukkan Keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="/ruangan" class="btn btn-warning">Kembali</a>
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