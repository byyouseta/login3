@if (!empty(Auth::user()->username))
        <script>window.location = "/home";</script>
@else
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{asset('adminlte/dist/img/LogoRSUP.png')}}">
    <title>RAPEL Login Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('/adminlte/plugins/iCheck/square/blue.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/custom.css')}}">
    <script type="text/javascript" src="{{asset('/js/jquery.js')}}"></script>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page bg">
    <div class="login-box">
        
        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="login-logo">
                <table class="table table-borderless text-left">
                    <tr><td rowspan="2">
                        <img src="{{asset('adminlte/dist/img/Logo.png')}}" alt="logo" />
                    </td>
                    <td>
                        <a href="#" ><b>R A P E L</b><br>
                    
                        <h5>Rapat Elektronik RSUP Surakarta</h5></a></td>
                    </tr>
                </table>
            </div>
            <p class="login-box-msg">Silahkan masuk untuk memulai sesi Anda</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Username" value="{{ old('email') }}">
                    </div>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                

                <div class="form-group has-feedback">
                    <div class="input-group">
                        <span class="input-group-addon" id="mybutton" onclick="change()"><i class="fa fa-eye"></i></span>
                        <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password">
                        
                    </div>
                
                    @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>

                

                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                        <h5 class="text-center"><strong>atau</strong></h5>
                        <a href="/tamu" class="btn btn-warning btn-block btn-flat">Presensi sebagai Tamu</a>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
        <div class="login-box-footer">
            <h5 class="text-center"><strong>Rapel 1.0 <br> Copyright &copy; 2021 IT <a href="https://rsupsurakarta.co.id/">RSUP Surakarta</a><br></strong> 
            All rights reserved.
        </div>
    </div>
    <!-- /.login-box -->
    

    <!-- jQuery 3 -->
    <script src="{{ asset('/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
    $(function () {
        $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
        });
    });
    </script>
    <script type="text/javascript">
        function change()
        {
        var x = document.getElementById('password').type;

        if (x == 'password')
        {
            document.getElementById('password').type = 'text';
            document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye-slash"></i>';
        }
        else
        {
            document.getElementById('password').type = 'password';
            document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye"></i>';
        }
        }
    </script>
    </div>
    </body>
    
    </html>
@endif