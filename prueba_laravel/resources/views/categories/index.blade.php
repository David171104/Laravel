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
  @php
  $categoryColor = $category->color ?? 'transparent';
  @endphp
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

    .color-container {
      width: 20px;

      height: 20px;

      display: inline-block;
      border: 1px solid #000;

      margin-right: 5px;

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


    li {
      list-style-type: none;
      text-decoration: none;
    }

    .footer {
      background-color: #333;
      color: #fff;
      padding: 20px 0;
      text-align: center;

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



  <!--Es una directiva que me pone un espacio-->
  @yield('content')
  <div class="container w-25 border p-4 my-4">
    <div class="row mx-auto">


      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('categories.store') }}">
              @csrf
              <!--cruz side request para que se pueda enviar el formulario. para contrarestar ataques laterales de hackers-->


              <div class="mb-3">
                <label for="name" class="form-label">Nombre de la categoría <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name" required>
              </div>

              <div class="mb-3">
                <label for="color" class="form-label">Color de la Categoría <span class="text-danger">*</span></label>
                <input type="color" class="form-control" name="color" id="color" required>
              </div>
              <button type="submit" class="btn btn-primary" title="Crear nueva categoría">Crear nueva categoría</button>
            </form>
          </div>


          @foreach ($categories as $category)
          <div class="row py-1">
            <div class="col-md-9 d-flex align-items-center">
              <span class="color-container me-2" style="background-color: {{ $category->color }};"></span>
              <p class="m-0" title="Mostrar productos que hay en esta categoría">
                {{ $category->name }}
              </p>
            </div>

            <!-- Botón para abrir la modal -->


            <div class="col-md-3 d-flex justify-content-end">
              <a class="d-flex align-items-center gap-2 btn btn-primary btn-sm me-2" href="{{ route('categories.show', ['id' => $category->id]) }}" title="Mostrar productos que hay en esta categoría">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                </svg>
              </a>
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminarCategoria-{{ $category->id }}" title="Eliminar Categoría">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                </svg>
              </button>
            </div>

            <!-- Modal para confirmar la eliminación -->
            <div class="modal fade" id="modalEliminarCategoria-{{ $category->id }}" tabindex="-1" aria-labelledby="modalEliminarCategoriaLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarCategoriaLabel">Eliminar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar la categoría <strong>{{ $category->name }}</strong>? Ten en cuenta que se eliminarán todos los productos que están dentro.
                  </div>
                  <div class="modal-footer">
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <div class="col-md-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Categoría">
                          Eliminar
                        </button>
                      </div>
                    </form>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="margin-top: auto;">
                      Cancelar
                    </button>
                  </div>



                </div>
              </div>
            </div>


          </div>
          @endforeach

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