<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .text-danger {
            color: red;
        }

        a {
            text-decoration: none;
        }

        li {
            text-decoration: none;
        }

        .p a {
            text-decoration: underline;
        }



        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .form-container h4 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .form-container label {
            margin-bottom: 10px;
        }

        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .form-container button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-container .mt-3 {
            text-align: center;
        }

        .form-container .mt-3 a {
            color: #007bff;
            text-decoration: none;
        }

        .form-container .mt-3 a:hover {
            text-decoration: underline;
        }
    </style>






</head>



<body class="main-layout">

    @yield('content')




    <div class="form-container container w-25 border p-4 mt-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <h6 class="alert-heading">Mensaje de Alerta:</h6>
            <ul style="list-style-type: none;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>

            @if(session('success'))
            <div class="alert alert-success">
                <p class="alert-heading">Mensaje de Alerta:</p>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form method="POST" action="{{ route('ingresar') }}">
            @csrf <!-- Protección contra CSRF -->
            <h4 class="text-center "><b>Iniciar Sesion</b></h4>
            <div class="mb-3">
                <label class="mb-2 text-muted my-4" for="email">Correo electrónico <span class="text-danger">*</span></label>
                <input id="email" type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label class="mb-2 text-muted" for="password">Contraseña <span class="text-danger">*</span></label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
                <a href="{{ route('olvidaste.contrasena') }}">¿Olvidaste tu contraseña?</a>

            </div>

            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>

        <p class="mt-3">¿No tienes una cuenta? <a href="{{ route('formulario-registro') }}" style="text-decoration: none;">Regístrate aquí</a></p>

    </div>









</body>



</html>