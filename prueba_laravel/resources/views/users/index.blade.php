<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Productos cliente</title>

    <style>
        body {
            font-family: Arial, sans-serif;
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

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;

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






    <div class="container mt-4">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <h3>
                        Todos los productos
                        <form action="{{ route('users.index') }}" method="GET" class="d-inline">
                            <select name="categoria" class="form-select my-3">
                                <option value="">Todas las categorías</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('categoria') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary" title="Mostrar productos">Mostrar</button>
                        </form>
                    </h3>

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
                    <div class="row my-4">
                        @if ($productos->isEmpty())
                        <p>No se encontraron productos.</p>
                        @else
                        <div class="row my-4">
                            @foreach ($productos as $producto)
                            @if ($producto->category && ($producto->category->id == intval(request('categoria')) || !request('categoria')))
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">


                                        <h5 class="card-title">{{ $producto->name }}</h5>
                                        <p class="card-text">{{ $producto->description }}</p>
                                        <p class="card-text"><strong>Precio:</strong> ${{ $producto->price }}</p>
                                        <!-- Botón para abrir la ventana modal -->
                                        <form action="{{ route('agregar-carrito', ['id' => $producto->id]) }}" method="POST">

                                            @csrf
                                            <input type="hidden" name="productId" value="{{ $producto->id }}">


                                            <button type="submit" class="btn btn-primary">Añadir al carrito</button>

                                        </form>

                                        <!-- Ventana modal -->


                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endif
                    </div>



                </div>

            </div>
        </div>



        <!-- Botón para crear producto -->
        <!-- Scripts de Bootstrap (Asegúrate de incluir las bibliotecas de JavaScript y jQuery de Bootstrap en tu proyecto) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+6HxzP6sgiC0ngfYFVcXaPbU7EiYI3E0D7J8YkE" crossorigin="anonymous"></script>
</body>

</html>