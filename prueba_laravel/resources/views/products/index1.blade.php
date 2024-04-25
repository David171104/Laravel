<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .table {
      background-color: #fff;
      /* Color de fondo de la tabla */
      border-collapse: collapse;
      /* Eliminar espacios entre las celdas */
    }

    .table th,
    .table td {
      border: none;
      /* Eliminar bordes de las celdas */
      padding: 8px;
      /* Espacio interno en las celdas */
    }

    .table th {
      background-color: #f2f2f2;
      /* Color de fondo de las cabeceras */
      color: white;
      /* Color del texto en los encabezados */
      font-weight: bold;
      /* Hacer el texto en los encabezados en negrita */
    }

    .table td {
      background-color: #ffffff;
      /* Color de fondo de las celdas */
      color: #333;
      /* Color del texto */
    }

    /* Evitar desplazamiento horizontal de la tabla */
    .table-responsive {
      overflow-x: auto;
    }

    li {
      list-style-type: none;
      text-decoration: none;
    }

    .footer {
      background-color: #A5A2A2;
      color: #fff;
      padding: 20px 0;
      text-align: center;

      bottom: 0;
      width: 100%;
    }

    /* Estilos para los botones */
    .btn-custom {
      background-color: #007bff;
      border-color: #007bff;
      color: #fff;
      transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #0056b3;
      border-color: #0056b3;
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

    .btn-custom svg {
      margin-right: 5px;
    }

    .btn-create-product {
      background-color: #28a745;
      border-color: #28a745;
      color: #fff;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-create-product:hover {
      transform: scale(1.05);
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-create-product svg {
      margin-right: 5px;
    }


    .alert {
      border-radius: 10px;

      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

      margin-bottom: 10px;

    }
  </style>
</head>

<body>
  <!--BARRA DE NAVEGACION-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light " style="padding-top: 10px; padding-bottom: 10px; ">
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
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="navbar-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#167799" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                      </svg> {{ $name }}
                    </div>
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

  <!--botones antiguos se le quita el css que esta en el head y ya

  <div class="container my-4 d-flex justify-content-between">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearProductoModal" title="Crear Producto">Crear Producto <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
      </svg></button>

    
    <div class="ms-2">
      <a href="{{ route('filtrar-producto') }}" class="btn btn-primary" title="Filtrar Producto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
        </svg></a>
    </div>
  </div>-->


  <!-- BOTON CREAR PRODUCTO -->
  <div class="container my-4 d-flex justify-content-between">
    <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#crearProductoModal" title="Crear Producto">Crear Producto
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
      </svg>
    </button>

    <!-- BOTON DE FILTRAR PRODUCTO -->
    <div class="ms-2">
      <a href="{{ route('filtrar-producto') }}" class="btn btn-custom" title="Filtrar Producto">

        Filtrar Producto <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
        </svg>
      </a>
    </div>
  </div>

  <!--MODAL CREAR PRODUCTO-->
  <div class="modal fade" id="crearProductoModal" tabindex="-1" aria-labelledby="crearProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearProductoModalLabel">Crear Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="{{ route('crear_productos') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nombre Producto <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="mb-3">
              <label for="category_id" class="form-label">Categoría del producto <span class="text-danger">*</span></label>
              <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Descripción <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="description" id="description" required>
            </div>

            <div class="mb-3">
              <label for="price" class="form-label">Precio <span class="text-danger">*</span></label>


              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" step="0.01" class="form-control" name="price" id="price" required>

              </div>
              <small id="priceHelp" class="form-text text-muted">Digitar solo numeros</small>
            </div>


            <button type="submit" class="btn btn-primary">Crear nuevo producto </button>
          </form>

        </div>
      </div>
    </div>
  </div>


  <!--ALERTAS VIEJAS-->
  <div class="row">
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




  <!--ALERTAS NUEVAS
  <div class="container text-center">
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="alert-heading">Mensaje de Alerta:</p>
      {{ Session::get('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <p class="alert-heading">Mensaje de Alerta:</p>
      {{ Session::get('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @error('pdf')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <p class="alert-heading">Mensaje de Alerta:</p>
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror

    @if ($errors->any())
    <div class="alert alert-danger">
      <h6 class="alert-heading">Mensaje de Alerta:</h6>
      <ul style="list-style-type: none;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  </div>-->













  <!--TABLA PRODUCTOS-->
  <div class="container my-4">
    <h3 class="mb-4">Lista de Productos</h3>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped table-hover"><!-- bordes verticales de la tabla table class="table table-bordered table-striped table-hover"-->
            <thead class="thead-dark"> <!--thead-dark--> <!--encabezado oscuro-->
              <tr>
                <th scope="col" width="22%" class="text-center">Nombre</th>
                <th scope="col" width="50%" class="text-center">Descripción</th>
                <th scope="col" width="15%">Precio</th>
                <th scope="col" width="10%" class="text-center">Estado</th>
                <th scope="col" width="13%" class="text-center">Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
                <td style="width: 22%;">{{ $product->name }}</td>
                <td style="width: 50%;"> {{ $product->description }}</td>
                <td style="width: 15%;"><span style="color: darkgreen;">$</span> {{ $product->price }}</td>

                <td style="width: 10%;">
                  @if ($product->status == 1)
                  <span class="badge bg-success">Disponible</span>
                  @elseif ($product->status == 2)
                  <span class="badge bg-warning">Comprado</span>
                  @endif
                </td>
                <td style="width: 13%;">
                  <div class="d-flex">
                    @if ($product->pdf)
                    <!--BOTON VER PDF-->
                    <a href="{{ route('ver-pdf', ['id' => $product->id]) }}" class="btn btn-primary btn-sm me-2" title="Ver el PDF">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                      </svg>
                    </a>

                    <!--BOTON DESCARGAR PDF-->
                    <a href="{{ route('download-pdf', ['productId' => $product->id]) }}" class="btn btn-primary btn-sm me-2" title="Descargar PDF">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                      </svg>
                    </a>
                    @else

                    <!--BOTON IMPORTAR PRODUCTO-->
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#importarProductoModal{{$product->id}}" title="Importar PDF">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5m-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5" />
                      </svg>
                    </button>
                    <div class="modal fade" id="importarProductoModal{{$product->id}}" tabindex="-1" aria-labelledby="importarProductoModalLabel{{$product->id}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h6 class="modal-title" id="importarProductoModalLabel{{$product->id}}">Importar Producto</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                            <form id="import-form-{{$product->id}}" class="my-4" method="POST" action="{{ route('products.storePdf', ['id' => $product->id]) }}" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="product_id" value="{{ $product->id }}">
                              <div class="input-group mb-3">
                                <label class="input-group-text" for="pdf">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5m-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5" />
                                  </svg>
                                </label>
                                <input type="file" class="form-control small" id="pdf" name="pdf" style="font-size:small;">


                              </div>
                              <small id="priceHelp" class="form-text text-muted my-3">El tamaño máximo del archivo es 2048KB</small>
                              <button type="submit" class="btn btn-primary my-4 mb-2" form="import-form-{{$product->id}}" onclick="return confirm('¿Estás seguro de que deseas importar este archivo?')">Importar</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>


                    @endif
                    <!--<a href="{{ route('editar-productos', ['id' => $product->id]) }}" class="btn btn-primary btn-sm mx-2">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                      </svg>
                    </a>-->
                    <!-- BOTON DE EDICION DE PRODUCTO -->
                    <a href="{{ route('editar-productos', ['id' => $product->id]) }}" class="btn btn-primary btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#editarProducto{{ $product->id }}" title="Editar Producto">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                      </svg>
                    </a>

                    <!-- MODAL DE  EDICION DE PRODUCTO-->
                    <div class="modal fade" id="editarProducto{{ $product->id }}" tabindex="-1" aria-labelledby="editarProducto{{ $product->id }}Label" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editarProducto{{ $product->id }}Label">Editar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                            <form method="POST" action="{{ route('actualizar-productos', ['id'=> $product->id ]) }}">
                              @method('PATCH')
                              @csrf

                              <div class="mb-3">
                                <label for="name" class="form-label">Nombre Producto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}" required>
                              </div>
                              <div class="mb-3">
                                <label for="category_id" class="form-label">Categoría del producto <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select">
                                  @foreach ($categories as $category)
                                  <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="description" class="form-label">Descripción <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="description" id="description" value="{{ $product->description }}" required>
                              </div>

                              <div class="mb-3">
                                <label for="price" class="form-label">Precio <span class="text-danger">*</span></label>


                                <div class="input-group">
                                  <span class="input-group-text">$</span>
                                  <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ $product->price }}" required>

                                </div>
                                <small id="priceHelp" class="form-text text-muted">Digitar solo numeros</small>
                              </div>

                              <button type="submit" class="btn btn-primary">Actualizar producto</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!--BOTON DE ELIMINAR PRODUCTO-->
                    <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#confirmDelteModal" title="Eliminar Producto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                      </svg></button>
                    <!--MODAL ELIMINAR PRODUCTO-->
                    <div class="modal fade" id="confirmDelteModal" tabindex="-1" role="dialog" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="confirmLogoutModalLabel">¿Estás seguro que deseas eliminar este producto?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('destroy-productos', [$product->id]) }}" method="POST" class="d-flex">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger btn-sm mx-2">Eliminar
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                </svg>
                              </button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div>
                      </div>
                    </div>


                    <!--BOTON DE DETALLES DE PRODUCTO-->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#productDetailsModal-{{ $product->id }}" data-product-id="{{ $product->id }}" title="Detalles de producto">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path d="M8 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0-4a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0-4a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                      </svg>
                    </button>

                    <!--MODAL DE DETALLES DE PRODUCTO-->
                    <div class="modal fade" id="productDetailsModal-{{ $product->id }}" tabindex="-1" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="productDetailsModalLabel">Detalles del Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p><strong>ID:</strong> {{ $product->id }}</p>
                            <p><strong>Nombre:</strong> {{ $product->name }}</p>
                            <p><strong>Descripción:</strong> {{ $product->description }}</p>
                            <p><strong>Precio:</strong> {{ $product->price }}</p>
                            <p><strong>Estado:</strong>@if ($product->status == 1)
                              <span class="badge bg-success">Disponible</span>
                              @elseif ($product->status == 2)
                              <span class="badge bg-warning">Comprado</span>
                              @endif
                            </p>

                            <p><strong>Creado en:</strong> {{ $product->created_at }}</p>
                            <p><strong>Actualizado en:</strong> {{ $product->updated_at }}</p>
                            <p><strong>Categoría:</strong> {{ $product->category->name }}</p>
                          </div>
                        </div>
                      </div>
                    </div>



                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center mt-4">
            <ul class="pagination">
              {{-- Previous Page Link --}}
              @if ($products->onFirstPage())
              <li class="page-item disabled">
                <span class="page-link">&laquo;</span>
              </li>
              @else
              <li class="page-item">
                <a href="{{ $products->previousPageUrl() }}" class="page-link" rel="prev">&laquo;</a>
              </li>
              @endif

              {{-- Pagination Elements --}}
              @for ($i = 1; $i <= $products->lastPage(); $i++)
                @if ($i == $products->currentPage())
                <li class="page-item active" aria-current="page">
                  <span class="page-link">{{ $i }}</span>
                </li>
                @else
                <li class="page-item">
                  <a href="{{ $products->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
                @endif
                @endfor

                {{-- Next Page Link --}}
                @if ($products->hasMorePages())
                <li class="page-item">
                  <a href="{{ $products->nextPageUrl() }}" class="page-link" rel="next">&raquo;</a>
                </li>
                @else
                <li class="page-item disabled">
                  <span class="page-link">&raquo;</span>
                </li>
                @endif
            </ul>
          </div>



        </div>
      </div>
    </div>
  </div>

  <!--FORMULARIO DE DESCARGA DE PDF EN CONJUNTO-->
  <!--<form class="container my-4" method="POST" action="{{ route('exportar-pdf') }}">
    @csrf
    @foreach ($products as $product)
    <div class="form-check mr-3">
      <input class="form-check-input" type="checkbox" name="products[]" value="{{ $product->id }}" id="product_{{ $product->id }}">
      <label class="form-check-label" for="product_{{ $product->id }}">{{ $product->name }}</label>
    </div>
    @endforeach
    <button type="submit" class="btn btn-primary mt-3" title="Descargar archivos ">Descargar Seleccionados</button>
  </form>-->



  <!--<div class="footer">
    <p>© 2024 Todos los derechos reservados</p>
  </div>-->

  <!-- Agrega la CDN de Bootstrap JS al final del body para que funcione correctamente -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>