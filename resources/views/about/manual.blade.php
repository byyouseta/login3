<!-- Menghubungkan dengan view template master -->
@extends('layouts.app')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Manual Sistem')


<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
<div class="box">
    @if(Auth::user()->level=='admin')
      <div class="box-header">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus-circle"></i> Tambah File</button> </a>
      </div>
    @endif
    @if(count($errors) > 0)
      <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
          {{ $error }} <br/>
          @endforeach
      </div>
    @endif
    @php
      $no=1;   
    @endphp
    <div class="box-body">
      <table class="table table-striped">
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama File</th>
            <th>Keterangan</th>
            <th style="width: 40px">Action</th>
          </tr>
        </tr>
          @forelse ($manual as $item)
            <th style="width: 5%">{{ $no++ }}</th>
            <th>{{ $item->nama }}</th>
            <th>{{ $item->keterangan }}</th>
            <th style="width: 10%">
              <div class="btn-group">
                <a href="/about/view/{{ Crypt::encrypt($item->namafile) }} " target="_blank" class="btn btn-primary btn-sm">
                <i class="fa fa-eye"></i></a>
                @if(Auth::user()->level=='admin')
                  
                  <a href="/about/delete/{{ Crypt::encrypt($item->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                    <i class="fa fa-trash-o"></i></a>
                @endif
              </div>
            </th>
          @empty
            <th colspan="4" class="text-center">Data Kosong</th>
          @endforelse
        
        </tr>        
      </table>
    </div>
    <!-- /.box-body -->
</div>

<!--modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah File</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="/about/upload" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Nama File</label>
                    <input type='text' class="form-control" name='namafile' />
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" rows="3" placeholder="Keterangan" name="keterangan"></textarea>
                  </div>
                <div class="form-group">
                    <label for="filepdf">File input</label>
                    <input type="file" id="filepdf" name="fileupload">
  
                    <p class="help-block">Maksimal file 2Mb</p>
                  </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection