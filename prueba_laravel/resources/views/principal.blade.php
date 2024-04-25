<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <title>Principal</title>

    <style>
        /* Estilos para las secciones Misión, Visión y Quiénes somos */
        body {
            font-family: Arial, sans-serif;

            color: #333;
        }

        .navbar {
            background-color: #ffffff;
        }

        .navbar-brand {
            font-weight: bold;
            color: #333;
        }

        .navbar-toggler {
            border-color: #333;
        }

        .navbar-nav .nav-link {
            color: #333;
            transition: color 1.3s ease;
        }

       
        




        .section-heading {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .section-content {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #666;
        }

        .contact-form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-color: #cccccc;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .map_section {
            margin-top: 40px;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;

            bottom: 0;
            width: 100%;
        }

        /* Agregar animación de entrada para las secciones */
        .reveal-section {
            opacity: 0;
            transform: translateY(20px);
            animation: reveal 1.2s ease forwards;
        }

        @keyframes reveal {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <form action="{{ route('barra-navegacion') }}">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg> Altamar Shop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#mision">Misión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#vision">Visión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#quienes-somos">Quiénes somos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('formulario-login') }}">Login <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <rect fill="none" height="24" width="24" />
                                    <path d="M12.29 8.71L11.59 8l-3.5 3.5 1.41 1.41L12 10.42l2.09 2.09 1.41-1.41-3.5-3.5zM12 1L2 11h3v9h14v-9h3L12 1zm0 4.58L16.58 10H7.42L12 5.58z" />
                                </svg>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('formulario-registro') }}">Regístrate <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5" />
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </form>
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


    <div id="mision" class="container-fluid py-5 bg-light reveal-section">
        <div class="container">
            <div class="section-heading text-center mb-5">
                <h2 class="section-title"> Misión</h2>
            </div>
            <div class="section-content">
                <p class="text-center">En nuestra tienda de electrodomésticos, nos esforzamos por proporcionar a nuestros clientes productos de alta calidad que simplifiquen sus vidas diarias y mejoren su bienestar en el hogar. Nos comprometemos a ofrecer una amplia gama de electrodomésticos innovadores y eficientes energéticamente, que no solo sean funcionales y duraderos, sino también respetuosos con el medio ambiente. Nuestra misión es ayudar a nuestros clientes a encontrar los productos adecuados que se ajusten a sus necesidades y presupuesto, al tiempo que ofrecemos un servicio excepcional y una experiencia de compra satisfactoria.</p>
            </div>
        </div>
    </div>

    <div id="vision" class="container-fluid py-5 reveal-section">
        <div class="container">
            <div class="section-heading text-center mb-5">
                <h2 class="section-title"> Visión</h2>
            </div>
            <div class="section-content">
                <p class="text-center">Nuestra visión es ser reconocidos como líderes en la industria de los electrodomésticos, siendo la primera opción para los consumidores que buscan calidad, variedad y servicio excepcional. Nos esforzamos por mantenernos a la vanguardia de la tecnología y las tendencias del mercado, ofreciendo siempre los productos más innovadores y actualizados. Aspiramos a ser una marca de confianza y a establecer relaciones duraderas con nuestros clientes, siendo su socio de confianza en todas sus necesidades de electrodomésticos.</p>
            </div>
        </div>
    </div>

    <div id="quienes-somos" class="container-fluid py-5 bg-light reveal-section">
        <div class="container">
            <div class="section-heading text-center mb-5">
                <h2 class="section-title">Quiénes Somos</h2>
            </div>
            <div class="section-content">
                <p class="text-center">Somos una tienda de electrodomésticos comprometida con la excelencia y la satisfacción del cliente. Nuestra pasión por mejorar el hogar y simplificar la vida cotidiana nos impulsa a ofrecer productos de la más alta calidad respaldados por un servicio excepcional. Con años de experiencia en la industria, hemos cultivado una reputación de confianza y fiabilidad entre nuestros clientes. Nos enorgullecemos de nuestro equipo de expertos en electrodomésticos, que están dedicados a ayudar a nuestros clientes a tomar decisiones informadas y encontrar los productos perfectos para sus necesidades específicas. En nuestra tienda, no solo vendemos electrodomésticos, creamos experiencias y construimos relaciones duraderas con nuestros clientes.</p>
            </div>
        </div>
    </div>

    <div id="contact" class="container-fluid py-5">
        <div class="container">
            <div class="section-heading text-center mb-5">
                <h2 class="section-title">Contáctanos</h2>
            </div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="contact-form">
                        <form id="request" class="main_form">
                            <div class="mb-3">
                                <input class="form-control" placeholder="Nombre" type="text" name="Nombre">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" placeholder="Teléfono" type="text" name="Telefono">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" placeholder="Correo" type="email" name="Correo">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="Mensaje" rows="4" name="Mensaje"></textarea>
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="map_section">
                        <div id="map" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="footer">
        <p>© 2024 Todos los derechos reservados</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>