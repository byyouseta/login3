@if (!empty(Auth::user()->username))
        <script>window.location = "/home";</script>
@else
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Kodinger" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>e-Agenda Login Page</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/css/my-login.css')}}" />
    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/my-login.js') }}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    
  </head>

  <body class="my-login-page">
    <section class="h-100">
      <div class="container h-100">
        <div class="row justify-content-md-center h-100">
          <div class="card-wrapper">
            <div class="brand">
              <img src="{{asset('adminlte/dist/img/Logo.png')}}" alt="logo" />
            </div>
            <div class="card fat">
              <div class="card-body">
                <h2 class="card text-center">e-Agenda</h2>
                <h4 class="card-title text-center">RSUP Surakarta</h4>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                  <div class="form-group">
                    
                    <input type="text" id="email" class="form-control" name="email" placeholder="Username" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  
                  <div class="form-group">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" required data-eye>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group m-0">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="footer">Copyright &copy; 2021 &mdash; TIK RSUP Surakarta</div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
@endif