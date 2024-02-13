<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | {{ env('STORE_NAME') }}
    </title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/toastr/toastr.min.css">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h4"><b>Login {{ env('STORE_NAME') }}
                    </b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('post.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="username" type="text" name="username" class="form-control" required placeholder="Username" autocomplete="off" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" name="password" class="form-control" required placeholder="Password" autocomplete="current-password" disabled>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" disabled>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" id="btn-login" class="btn btn-primary btn-block" disabled>Sign
                                In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('adminlte') }}/plugins/toastr/toastr.min.js"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <script type="text/javascript">
        $("#username").keyup(function() {
            var username = $("#username").val();

            if (username.length >= 5) {
                $.ajax({
                    type: "GET",
                    data: {
                        username: username
                    },
                    dataType: "JSON",
                    url: "{{ url('/login/cek-username/json') }}",
                    success: function(data) {
                        if (data.success) {
                            $("#username").removeClass("is-invalid");
                            $("#username").addClass("is-valid");
                            $("#password").val('');
                            $("#password").removeAttr("disabled", "disabled");
                        } else {
                            $("#username").removeClass("is-valid");
                            $("#username").addClass("is-invalid");
                            $("#password").val('');
                            $("#password").attr("disabled", "disabled");
                            $("#remember").attr("disabled", "disabled");
                            $("#btn-login").attr("disabled", "disabled");
                        }
                    },
                    error: function() {}
                });
            } else {
                $("#username").removeClass("is-valid");
                $("#username").removeClass("is-invalid");
                $("#password").val('');
                $("#password").attr("disabled", "disabled");
                $("#remember").attr("disabled", "disabled");
                $("#btn-login").attr("disabled", "disabled");
            }
        });

        $("#password").keyup(function() {
            var username = $("#username").val();
            var password = $("#password").val();

            if (password.length >= 5) {
                $.ajax({
                    type: "GET",
                    data: {
                        username: username,
                        password: password
                    },
                    dataType: "JSON",
                    url: "{{ url('login/cek-password/json') }}",
                    success: function(data) {
                        if (data.success) {
                            $("#password").removeClass("is-invalid");
                            $("#password").addClass("is-valid");
                            $("#remember").removeAttr("disabled", "disabled");
                            $("#btn-login").removeAttr("disabled", "disabled");
                        } else {
                            $("#password").removeClass("is-valid");
                            $("#password").addClass("is-invalid");
                            $("#remember").attr("disabled", "disabled");
                            $("#btn-login").attr("disabled", "disabled");
                        }
                    },
                    error: function() {}
                });
            } else {
                $("#password").removeClass("is-valid");
                $("#password").removeClass("is-invalid");
                $("#remember").attr("disabled", "disabled");
                $("#btn-login").attr("disabled", "disabled");
            }
        });
        // var flash = "{{ Session::has('sukses') }}";
        // if (flash) {
        //   var pesan = "{{ Session::get('sukses') }}"
        //   toastr.success("{{ Session::get('sukses') }}")
        // }
        // var gagal = "{{ Session::has('gagal') }}";
        // if (gagal) {
        //   var pesan = "{{ Session::get('gagal') }}"
        //   toastr.error("{{ Session::get('gagal') }}")
        // }
        // var info = "{{ Session::has('info') }}";
        // if (info) {
        //   var pesan = "{{ Session::get('info') }}"
        //   toastr.info("{{ Session::get('info') }}")
        // }
        // var peringatan = "{{ Session::has('peringatan') }}";
        // if (peringatan) {
        //   var pesan = "{{ Session::get('peringatan') }}"
        //   toastr.warning("{{ Session::get('peringatan') }}")
        // }

        $(function() {
            $(document).ready(function() {
                var flash = "{{ Session::has('sukses') }}";
                if (flash) {
                    var pesan = "{{ Session::get('sukses') }}"
                    toastr.success("{{ Session::get('sukses') }}")
                }
                var gagal = "{{ Session::has('gagal') }}";
                if (gagal) {
                    var pesan = "{{ Session::get('gagal') }}"
                    toastr.error("{{ Session::get('gagal') }}")
                }
                var info = "{{ Session::has('info') }}";
                if (info) {
                    var pesan = "{{ Session::get('info') }}"
                    toastr.info("{{ Session::get('info') }}")
                }
                var peringatan = "{{ Session::has('peringatan') }}";
                if (peringatan) {
                    var pesan = "{{ Session::get('peringatan') }}"
                    toastr.warning("{{ Session::get('peringatan') }}")
                }
            });
        })
    </script>
</body>

</html>