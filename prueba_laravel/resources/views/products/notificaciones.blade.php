<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notificaciones</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

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

    li {
      list-style-type: none;
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
  <div class="container">
    <h4 class="my-4">Envio de notificaciones</h4>

    <form action="{{ route('enviar.promociones') }}" method="GET">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="m-0">Enviar notificaciones de promociones a usuarios nuevos</p>
        <button type="submit" class="btn btn-primary">Enviar promociones</button>
      </div>

    </form>

  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>