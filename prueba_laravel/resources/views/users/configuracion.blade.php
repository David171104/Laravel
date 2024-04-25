<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style-type: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .delete-form {
            margin-top: 20px;
        }

        .cancel-button {
            margin-right: 10px;
        }

        #modalToggle:checked+.modal {
            display: flex;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .btn:hover {
            /* Agrega aquí la animación que desees */
            transform: translateY(-5px);
            /* Ejemplo: Mover hacia arriba */
        }

        /* Regla CSS para la animación cuando el cursor está sobre el enlace */
        a.btn:hover {
            /* Agrega aquí la animación que desees */
            transform: translateY(-5px);
            /* Ejemplo: Mover hacia arriba */
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding-top: 10px; padding-bottom: 10px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Usuario</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('users.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carrito') }}">Carrito</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <div class="dropdown mr-5">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                            <span class="navbar-text">{{ $name }}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item small" href="{{ route('perfil.editar') }}">Perfil</a>
                            <a class="dropdown-item small" href="{{ route('perfil.mostrar') }}">Configuración</a>
                            <hr class="dropdown-divider mx-3 my-0 mt-2">
                            </hr>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item small">
                                        <button type="button" class="btn btn-link ml-3 text-decoration-none" data-toggle="modal" data-target="#exampleModal" title="Cerrar sesión">
                                            <span class="nav-item small">Cerrar sesión</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                                                <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                            </svg>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>


    <!-- Ventana modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de que deseas cerrar sesión?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <!-- Formulario para cerrar sesión -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="nav-link">
                        @csrf

                        <button type="submit" class="btn btn-primary">Si </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--ALERTAS VIEJAS-->
    <div class="row my-4">
        <div class="container text-center">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show  position-relative" role="alert">
                <p class="alert-heading">Mensaje de Alerta:</p>
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show  position-relative" role="alert">
                <p class="alert-heading">Mensaje de Alerta:</p>
                {{ Session::get('error') }}
                <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif



            @if ($errors->any())
            <div class="alert alert-danger  position-relative">
                <h6 class="alert-heading">Mensaje de Alerta:</h6>
                <ul style="list-style-type: none;">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>


                <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
            @endif


        </div>
    </div>

    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header " style="color: #C33E34;">
                <h3 class="my-3">Información del Usuario</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="text" class="form-control" id="password" value="******" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha" class="form-label">Fecha de Creación:</label>
                            <input type="text" class="form-control" id="fecha" value="{{ $user->created_at }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono" class="form-label  my-2">Número de Teléfono:<span class="text-danger">*</span></label><br>
                            @if($user->telefono)
                            <input type="tel" id="telefono" name="telefono" class="form-control" value="{{ substr($user->telefono, strpos($user->telefono, ' ') + 2) }}" readonly>

                            @else
                            <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="No tiene teléfono registrado" readonly>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    Eliminar Cuenta
                </button>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteAccountModalLabel">Confirmar Eliminación de Cuenta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">

                    <form action="{{ route('perfil.eliminar') }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="container">
        <h3 class="my-4">Información del Usuario</h3>

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="text" class="form-control" id="password" value="******" readonly>
        </div>


        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de creacion</label>
            <input type="text" class="form-control" id="fecha" value="{{ $user->created_at }}" readonly>
        </div>
        
        <label for="modalToggle" class="btn btn-danger">Eliminar Cuenta</label>

        <input type="checkbox" id="modalToggle" hidden>
        <div class="modal">
            <div class="modal-content">
                <label for="modalToggle" class="close-button">&#10006;</label>
                <div class="modal-body">
                    <h3>Confirmar Eliminación de Cuenta</h3>
                    <p>¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.</p>
                   
                    <form action="{{ route('perfil.eliminar') }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
                        
                        <label for="modalToggle" class="btn btn-secondary cancel-button">Cancelar</label>
                    </form>
                </div>
            </div>
        </div>

    </div>-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>