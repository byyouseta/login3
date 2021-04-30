@extends('layouts.app')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Daftar Unit')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Unit</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="/unit/tambahunit" method="post">
                {{ csrf_field() }}
                <!-- text input -->
                    <div class="form-group">
                        <label>Nama Unit</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama Unit" name="nama_unit">
                        @if($errors->has('nama_unit'))
                            <div class="text-danger">
                                {{ $errors->first('nama_unit')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" rows="3" placeholder="Masukkan Keterangan" name="keterangan"></textarea>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="/unit" class="btn btn-warning">Kembali</a>
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