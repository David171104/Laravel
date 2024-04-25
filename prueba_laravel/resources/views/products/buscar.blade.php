<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Búsqueda de Productos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table {
            background-color: #ffffff;
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            border: none;
            padding: 12px;
            vertical-align: top;
            text-align: left;
            background-color: #f9f9f9;
            /* Mismo color para todas las celdas */
        }

        .table th {
            background-color: #167799;
            color: #ffffff;
            font-weight: bold;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        li {
            list-style-type: none;
            text-decoration: none;
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

    <!--BARRA DE NAVEGACION-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light " style="padding-top: 10px; padding-bottom: 10px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('products.index1') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('categories.index') }}">Categorias</a>
                    </li>
                </ul>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container">
                        <div class="d-flex align-items-center">
                            <div class="nav-item">
                                <div class="dropdown mr-5">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="navbar-text"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                                            </svg> {{ $name }}</div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item small" href="{{ route('perfil.editaradmin') }}">Editar Perfil</a>
                                        <a class="dropdown-item small" href="{{ route('perfil.editarusuarios') }}">Configuración de usuarios</a>
                                        <a class="dropdown-item small" href="{{ route('perfil.notificaciones') }}">Notificaciones</a>
                                        <hr class="mx-3 my-0 mt-2">
                                        </hr>
                                        <div class="collapse navbar-collapse" id="navbarNav">

                                            <ul class="navbar-nav ml-auto">
                                                <li class="nav-item small">
                                                    <button type="button" class="btn btn-link ml-3 text-decoration-none" data-toggle="modal" data-target="#confirmLogoutModal" title="Cerrar Sesión">
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
                            <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="sr-only">Toggle navigation</span>
                            </button>
                        </div>

                    </div>
                </nav>


                <!--MODAL CERRAR SESION-->

                <div class="modal fade" id="confirmLogoutModal" tabindex="-1" role="dialog" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmLogoutModalLabel">¿Estás seguro de cerrar la sesión?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Sí</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>




    <!-- POSICIONAMIENTO DE PLACEHOLDERS   UNO ABAJO DEL OTRO   <div class="row justify-content-center mb-4">
            <form action="{{ route('filtrar-producto') }}" method="GET" class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control mr-3" name="name" placeholder="Nombre del producto" value="{{ $filtros['name'] ?? '' }}" style="width: 300px;">
                    <input type="text" class="form-control my-3 mr-3" name="description" placeholder="Descripción del producto" value="{{ $filtros['description'] ?? '' }}" style="width: 300px;">
                    <input type="number" step="0.01" class="form-control my-3 mr-3" name="price" id="price" placeholder="Precio del producto " value="{{ $filtros['price'] ?? '' }}" style="width: 300px;">


                    <select name="categoria" class="form-select my-3 mr-3" style="width: 300px;">
                        <option value="">Todas las categorías</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == request('categoria') ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>

                </div>
                <div class="d-flex justify-content-end my-3">
                    <button type="submit" class="btn btn-primary mr-4" title="Buscar">Buscar</button>
                    <a href="{{ route('limpiar-filtros') }}" class="btn btn-secondary" title="Limpiar filtros">Limpiar filtros</a>
                </div>
            </form>
        </div>-->









    <div class="container mt-5">
        <h3 class="text-center mb-4">Búsqueda de Productos</h3>

        <div class="row justify-content-center mb-4">
            <form action="{{ route('filtrar-producto') }}" method="GET" class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control mr-3" name="name" placeholder="Nombre del producto" value="{{ $filtros['name'] ?? '' }}" style="width: 200px;">
                    <input type="text" class="form-control mr-3" name="description" placeholder="Descripción del producto" value="{{ $filtros['description'] ?? '' }}" style="width: 200px;">
                    <input type="number" step="0.01" class="form-control my-3 mr-3" name="price" id="price" placeholder="Precio del producto " value="{{ $filtros['price'] ?? '' }}" style="width: 160px;">


                    <select name="categoria" class="form-select my-3 mr-3" style="width: 160px;">
                        <option value="">Todas las categorías</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == request('categoria') ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>

                </div>
                <div class="d-flex justify-content-end my-4">
                    <button type="submit" class="btn btn-primary mr-4" title="Buscar" style="background-color: #167799;">Buscar</button>
                    <a href="{{ route('limpiar-filtros') }}" class="btn btn-secondary" title="Limpiar filtros">Limpiar filtros</a>
                </div>
            </form>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                @if(isset($productos))
                @if($productos->isEmpty())
                <p class="text-center">No se encontraron productos que coincidan con la búsqueda.</p>
                @else
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col" width="10%">ID</th>
                                <th scope="col" width="30%">Nombre</th>
                                <th scope="col" width="45%">Descripción</th>
                                <th scope="col" width="15%">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->name }}</td>
                                <td>{{ $producto->description }}</td>
                                <td><span style="color: darkgreen;">$</span> {{ $producto->price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>




                </div>
                @endif
                @else
                <p class="text-center">No se ha realizado ninguna búsqueda.</p>
                @endif
            </div>
        </div>

      
        <div style="margin-bottom: 60px;"></div>



        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


        <!-- Botón para crear producto -->
        <!-- Scripts de Bootstrap (Asegúrate de incluir las bibliotecas de JavaScript y jQuery de Bootstrap en tu proyecto) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

        <script src="'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>