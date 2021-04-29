@extends('layouts.app')
@section('judul_halaman', 'Change Password')
@section('konten')
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
        
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/password/ganti" method="post">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Password lama</label>
                    <input type="password" class="form-control" name="password" placeholder="Password Lama">
                </div>

                @if($errors->has('password'))
                    <div class="text-danger">
                        {{ $errors->first('password')}}
                    </div>
                @endif

                <div class="form-group">
                    <label for="exampleInputPassword1">Password Baru</label>
                    <input type="password" class="form-control" name="password_new" placeholder="Password Baru">
                </div>

                @if($errors->has('password_new'))
                    <div class="text-danger">
                        {{ $errors->first('password_new')}}
                    </div>
                @endif

                <div class="form-group">
                    <label for="exampleInputPassword1">Ulangi Password Baru</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi Password Baru">
                </div>

                @if($errors->has('password_confirmation'))
                    <div class="text-danger">
                        {{ $errors->first('password_confirmation')}}
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
        <!-- /.box -->
        @if(!empty($pesan))
        <div class="alert alert-success alert-block">
		        <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $pesan }}</strong>
	    </div>
        @endif
    </div>
</div>
@endsection