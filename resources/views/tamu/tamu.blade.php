<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>e-Agenda Tamu Daskboard</title>
  
  <style>
    body { font: normal 100.01%/1.375 "Helvetica Neue",Helvetica,Arial,sans-serif; }
  </style>
  <link href="{{asset('/css/jquery.signaturepad.css')}}" rel="stylesheet">
  
  <!--[if lt IE 9]><script src="../assets/flashcanvas.js"></script><![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/adminlte/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/custom.css')}}">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
</head>
<body class="hold-transition register-page bg">
<section class="register-box">
  <div class="row">
    <!-- left column -->
    <div class="col-md-13">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Presensi Agenda</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        @if(count($errors) > 0)
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
          {{ $error }} <br/>
          @endforeach
        </div>
        @endif
        @if(session()->has('message'))
          <div class="alert alert-success">
              {{ session()->get('message') }}
          </div>
        @endif
        
        <form method="post" action="/presensitamu" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="nama">Agenda Hari ini</label>
              <select class="form-control select2 " style="width: 100%;" name="agenda">
                <option selected value="" active>Pilih</option>
                  @foreach($agenda as $a)
                    <option value="{{ $a->id}}">{{ $a->nama_agenda }}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="nama">Nama Lengkap</label>
              <input type="text" class="form-control" id="name" placeholder="Isikan Nama Lengkap Anda" name="nama">
            </div>
            <div class="form-group">
              <label for="NIP">NIP/NIK</label>
              <input type="text" class="form-control" id="NIP" placeholder="Isikan NIP/NIK Anda" name="nip">
            </div>
            <div class="form-group">
              <label for="Unit">Instansi/Unit/Satker</label>
              <input type="text" class="form-control" id="unit" placeholder="Isikan Instansi/Unit/Satker Anda" name="unit">
            </div>
            <div class="form-group">
              <label for="no_hp">Nomor Handphone Aktif</label>
              <input type="text" class="form-control" id="no_hp" placeholder="Isikan No Handphone Anda" name="no_hp">
            </div>
            <div class="form-group">
              <label for="email">Email Aktif</label>
              <input type="text" class="form-control" id="email" placeholder="Isikan Email Anda" name="email">
            </div>
            <!-- /.box-body -->
            <!--
            <label for="name">Nama</label>
            <input type="text" name="nama" id="name" class="name">
            --><!-- //untuk saat ini tidak pakai orek2 ttd dl, susah 
            <div class="form-group">
              <div class="sigPad">
                <p class="typeItDesc">Melihat tanda tangan</p>
                <p class="drawItDesc">Tuliskan tanda tangan mu</p>
                <ul class="sigNav">
                   <li class="typeIt"><a href="#type-it" class="current">Menggunakan Nama</a></li> 
                  <li class="drawIt"><a href="#draw-it" current>Klik untuk Tanda Tangan</a></li>
                  <li class="clearButton"><a href="#clear">Clear</a></li>
                </ul>
              
                <div class="sig sigWrapper">
                  <div class="typed"></div>
                  <canvas class="pad" width="370" height="100"></canvas>
                  
                </div>
              </div>
            </div>-->
            <div class="form-group">
              <label for="captcha">Captcha</label>
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
              <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="/" class="btn btn-warning">Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

  <script src="{{asset('/js/jquery.signaturepad.js')}}"></script>
  <script>
    $(document).ready(function() {
      $('.sigPad').signaturePad();
    });
  </script>
  <script src="{{asset('/js/json2.min.js')}}"></script>
</body>
