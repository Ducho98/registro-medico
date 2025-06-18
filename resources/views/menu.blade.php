<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
    <!-- FANCYBOX -->
    <link href="{{ asset('storage/css/jquery.fancybox.css') }}" rel="stylesheet"/>
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        .color-container{
            width: 16px;
            height: 16px;
            display: inline-block;
            border-radius: 4px;
        }
        a{
            text-decoration: none;
        }
        pre{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('ver-especialidades') }}">Registro Médico</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link"><strong>Bienvenido {{ session('usuario') }}</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ver-perfil') }}">Mi perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('antecedentes') }}">Antecedentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('agregar_especialidad') }}">Agregar Especialidad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cerrarSesion') }}">Cerrar Sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('content')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'
    
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
    
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }
    
                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- FANCYBOX -->
    <script src="{{ asset('storage/js/jquery.fancybox.js') }}"></script>
</body>
</html>