<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    <style>
        .gradient-custom-2 {

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #189292, #222F59);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #189292, #222F59);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }
        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>

</head>
<body style="background-color: #eee;">

<section class="h-100 gradient-form">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-6">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <div class="card-body p-md-5 mx-md-4">

                                <h1 class="py-5 text-center">INNCLOD</h1>

                                <form method="post" action="{{route('auth')}}" id="formLogin">
                                    @csrf

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Correo:</label>
                                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Digite el correo electronico" name="email" value="{{old('email')}}"
                                               autofocus/>
                                        @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Contraseña:</label>
                                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Digite la contraseña"/>
                                        @error('password')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-warning btn-block fa-lg mb-3" type="submit">
                                            Iniciar sesión
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{asset('vendor/jquery/jqueryUtility.js')}}"></script>

<script>
    $("#formLogin").submit(function () {
        $(this).loading()
    })
</script>

</body>
</html>

