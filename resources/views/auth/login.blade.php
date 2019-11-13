<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login Admin</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin_assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin_assets/bower_components/Ionicons/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin_assets/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin_assets/plugins/iCheck/square/blue.css')}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>Sewain</b>Apps</a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Masukan Username & Password Anda</p>
                @error('username')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                    Maaf Username atau Password Salah.
                </div>
                @enderror
                @error('password')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                    Maaf Username atau Password Salah.
                </div>
                @enderror
                <form method="POST" action="{{ route('admlogin') }}">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="new-username" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" id="password" class="form-control" placeholder="Password" name="password" autocomplete="new-password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" onclick="tampilsandi()"> Lihat Password
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center">
                    <a href="{{url('/')}}" class="btn btn-block btn-danger">Halaman Awal</a>
                </div>
            </div>
        </div>
        <script src="{{asset('admin_assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admin_assets/plugins/iCheck/icheck.min.js')}}"></script>
        <script>
        $(function () {
        $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
        });
        $('input').on('ifClicked',function(event){
        var x = document.getElementById("password");
        if (x.type === "password") {
        x.type = "text";
        }else{
        x.type = "password";
        }
        });
        });
        </script>
    </body>
</html>