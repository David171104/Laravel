<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Carrito</title>

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

        .shopping-cart {
            position: relative;
            width: 750px;
            height: auto;
            margin: 80px auto;
            background: #FFFFFF;
            box-shadow: 1px 2px 3px 0px rgba(0, 0, 0, 0.10);
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .cart-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 24px;
            color: #333;
            cursor: pointer;
        }

        .buy-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .cart-item {
            display: flex;
            padding: 20px 30px;
            border-bottom: 1px solid #E1E8EE;
        }

        .product-details {
            flex: 1;
        }

        .counter {
            display: flex;
            align-items: center;
        }

        .counter button {
            padding: 5px;
        }

        .counter span {
            margin: 0 10px;
        }

        .price-section {
            font-size: 16px;
            color: #333;
            margin-top: 10px;
        }

        .checkout-section {
            border-top: 1px solid #ddd;
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .checkout-section button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            ;
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



    <div class="row justify-content-center align-items-center my-4">
        <h3 class="text-center">Carrito de compras</h3>


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
    </div>

    <div class="shopping-cart">
        @if (!empty($productosCarrito))
        <div class="cart-header row">
            <div class="col">
                <h5 scope="col" width="20%" class="text-center">Nombre</h5>
            </div>
            <div class="col">
                <h5 scope="col" width="20%" class="text-center">Descripcion</h5>
            </div>
            <div class="col">
                <h5 scope="col" width="20%" class="">Cantidad</h5>
            </div>
            <div class="col">
                <h5 scope="col" width="20%" class="">Precio</h5>
            </div>
            <div class="col">
                <h5 scope="col" width="20%" class="">Acciones</h5>
            </div>
        </div>
        @foreach ($productosCarrito as $item)
        <!-- Botón Eliminar -->
        <div class="cart-item row align-items-center">
            <div class="col">
                <div class="product-details">
                    <h6>{{ isset($item['producto']->name) ? $item['producto']->name : 'Nombre no disponible' }}</h6>
                </div>
            </div>
            <div class="col">
                <div class="product-details">
                    <p>{{ isset($item['producto']->description) ? $item['producto']->description : 'Descripción no disponible' }}</p>
                </div>
            </div>
            <div class="col">
                <div class="counter">
                    <form action="{{ route('aumentar-cantidad', ['id' => $item['producto']->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">+</button>
                    </form>
                    <span>{{ isset($item['cantidad']) ? $item['cantidad'] : 'Cantidad no disponible' }}</span>
                    <form action="{{ route('disminuir-cantidad', ['id' => $item['producto']->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">-</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <div class="price-section">
                    <p>{{ isset($item['producto']->price) ? ' $' . $item['producto']->price : 'Precio no disponible' }}</p>
                </div>
            </div>
            <div class="col d-flex justify-content-between">
                <form class="d-inline" action="{{ route('comprar-producto', ['id' => $item['producto']->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" title="Comprar producto"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1" />
                        </svg></button>
                </form>
                <!-- Botón de modal -->
                <button type="button" class="btn btn-danger btn-sm me-2" data-bs-toggle="modal" data-bs-target="#removeFromCartModal{{ $item['producto']->id }}" title="Quitar producto de mi carrito">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="10px" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" style="width: 1em; height: 1em;">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Ventana modal para Eliminar -->
        <div class="modal fade" id="removeFromCartModal{{ $item['producto']->id }}" tabindex="-1" aria-labelledby="removeFromCartModalLabel{{ $item['producto']->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removeFromCartModalLabel{{ $item['producto']->id }}">¿Estás seguro de que deseas quitar este producto de tu carrito?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('eliminar-carrito', ['id' => $item['producto']->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="cart-item">
            <p>No hay productos en el carrito.</p>
        </div>
        @endif
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <!-- Botón para crear producto -->
    <!-- Scripts de Bootstrap (Asegúrate de incluir las bibliotecas de JavaScript y jQuery de Bootstrap en tu proyecto) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>