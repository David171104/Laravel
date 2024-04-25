<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <title>Lista de Productos</title>

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

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
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


    <!--<nav class="navbar navbar-expand-lg navbar-light bg-light my-4">
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
                        <a class="nav-link" href="{{ route('categories.index') }}">Categorias</a>
                    </li>
                </ul>
                <div class="ml-4  mr-4" style="font-size: 80%;">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container">
                            <div class="d-flex align-items-center">
                                <div class="nav-item">
                                    <div class="dropdown mr-5 ">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="navbar-text"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                                                </svg> {{ $name }}</div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm ml-2 " aria-labelledby="navbarDropdown" style="max-width: 100px;">
                                            <a class="dropdown-item " href="{{ route('perfil.editaradmin') }}" >Editar Perfil</a>
                                            <a class="dropdown-item " href="{{ route('perfil.editarusuarios') }}" >Configuración de usuarios</a>
                                            <a class="dropdown-item " href="{{ route('perfil.notificaciones') }}" >Notificaciones</a>

                                            <hr class="mx-3 my-0 mt-2">
                                            </hr>
                                            <div class="collapse navbar-collapse" id="navbarNav">
                                                <ul class="navbar-nav ml-auto">
                                                    <li class="nav-item small">
                                                        <button type="button" class="btn btn-link ml-3 text-decoration-none" data-toggle="modal" data-target="#exampleModal" title="Cerrar Sesión" style="font-size: 80%;">
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
                   
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex">
                        @csrf
                        <button type="button" class="btn btn-secondary" style="margin-right: 8px;" data-dismiss="modal">Cancelar</button>
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary" style="margin-left: 8px;">Si

                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>



    </div>
    </div>
    </nav>-->

    <!--Es una directiva que me pone un espacio-->

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




    @yield('content')
    <div class="container w-25 border p-4 my-4">
        <div class="row mx-auto">

            <form method="POST" action="{{ route('categories.update', ['id' => $category->id]) }}">
                @method('PATCH')
                @csrf


                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la categoría <span class="text-danger">*</span></label>
                    <!-- Rellena el campo "name" con el valor actual de la categoría -->
                    <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Color de la Categoría <span class="text-danger">*</span></label>
                    <!-- Rellena el campo "color" con el valor actual de la categoría -->
                    <input type="color" class="form-control" name="color" id="color" value="{{ $category->color }}" required>
                </div>

                <button type="submit" class="btn btn-primary" title="Editar categoría">Editar categoría</button>
            </form>
            <div>
                @if ($category->products->count() >0)
                @foreach ($category->products as $product)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <p href="#" class="my-2">{{ $product->name }}</p>
                    </div>
                    <div class="modal fade" id="eliminarProductoModal{{ $product->id }}" tabindex="-1" aria-labelledby="eliminarProductoModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eliminarProductoModalLabel{{ $product->id }}">Eliminar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar el producto <strong>{{ $product->name }}</strong>? Ten en cuenta que esta acción no se puede deshacer.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('destroy-productos', ['id' => $product->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex justify-content-end">

                        <a class="d-flex align-items-center gap-2 btn btn-primary btn-sm me-2" id="editarProducto{{ $product->id }}" href="#" data-bs-toggle="modal" data-bs-target="#editarProductoModal{{ $product->id }}" title="Editar productos"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarProductoModal{{ $product->id }}" title="Eliminar Producto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                            </svg>
                        </button>
                    </div>

                </div>

                <!-- Ventana modal -->
                <div class="modal fade" id="editarProductoModal{{ $product->id }}" tabindex="-1" aria-labelledby="editarProducto{{ $product->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarProducto{{ $product->id }}Label">Editar Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulario de edición -->
                                <form method="POST" action="{{ route('editar-producto-categories', ['producto_id' => $product->id, 'categoria_id' => $product->category->id ]) }}">


                                    @csrf

                                    <!-- Campos del formulario -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre Producto <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}" required>
                                    </div>



                                    <div class="mb-3">
                                        <label for="description" class="form-label">Descripción <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="description" id="description" value="{{ $product->description }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category" class="form-label">Categoría del producto <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="category" name="category" value="{{ $product->category->name }}" readonly>

                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Precio <span class="text-danger">*</span></label>


                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ $product->price }}" required>

                                        </div>
                                        <small id="priceHelp" class="form-text text-muted">Digitar solo numeros</small>
                                    </div>
                                    <!-- Botón de enviar formulario -->
                                    <button type="submit" class="btn btn-primary">Actualizar producto</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @else

                No hay productos para esta categoria
                @endif



            </div>
        </div>
    </div>

    <!-- Botón para crear producto -->
    <!-- Scripts de Bootstrap (Asegúrate de incluir las bibliotecas de JavaScript y jQuery de Bootstrap en tu proyecto) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


</body>

</html>