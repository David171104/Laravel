<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <title>Registrate</title>





    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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

        .text-danger {
            color: red;
        }

        a {
            text-decoration: none;
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

   


    <div class=" form-container container w-25 border p-4 mt-4" style="margin-top: 80px; ">
        <form method="POST" action="{{ route('registro-usuario') }}">
            @csrf <!-- Protección contra CSRF -->







            <!--ALERTAS-->
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p class="alert-heading">Mensaje de Alerta:</p>
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="alert-heading">Mensaje de Alerta:</p>
                        {{ session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @error('password')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="alert-heading">Mensaje de Alerta:</p>
                        <h6 class="alert alert-danger">{{ $message }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    @error('telefono')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="alert-heading">Mensaje de Alerta:</p>
                        <h6 class="alert alert-danger">{{ $message }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    <!-- Mensajes de error -->
                    @error('name')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="alert-heading">Mensaje de Alerta:</p>
                        <h6 class="alert alert-danger">{{ $message }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    @if(Session::has('email'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="alert-heading">Mensaje de Alerta:</p>
                        <h6 class="alert alert-danger">{{ $message }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif



                    @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        <h6 class="alert-heading">Mensaje de Alerta:</h6>
                        <p>El correo electrónico ya está siendo utilizado por otro usuario.</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                </div>
            </div>


            <h4 class="text-center "><b>Registro</b></h4>
            <!-- Campo de nombre -->
            <div class="mb-3 my-4">
                <label for="name" class="form-label text-muted">Nombre <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name">
            </div>

            <!-- Campo de correo electrónico -->
            <div class="mb-3">
                <label class="form-label text-muted" for="email">Correo electrónico <span class="text-danger">*</span></label>
                <input id="email" type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label  class="form-label text-muted" for="telefono">Número de Teléfono<span class="text-danger">*</span>:</label><br>
                <select id="pais" name="pais" class="form-select my-3 ">
                    <option value="+57">Colombia (+57)</option>
                    <option value="+1">Estados Unidos (+1)</option>
                    <option value="+44">Reino Unido (+44)</option>
                    <option value="+52">México (+52)</option>
                    <option value="+34">España (+34)</option>
                    <!-- Agrega más opciones según los países que desees -->
                </select>
                <input type="tel" id="telefono" name="telefono" class="form-control d-flex text-muted" placeholder="Ingrese su numero " required>
                 <!-- Campo oculto para almacenar el prefijo del país -->
            </div>


            <!-- Campo de contraseña -->
            <div class="mb-3">
                <label class="form-label text-muted" for="password">Contraseña <span class="text-danger">*</span></label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <!-- Checkbox de aceptar términos y condiciones -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terminos" name="terminos" required>
                <label class="form-check-label" for="terminos">He leído y acepto los <a href="#" data-bs-toggle="modal" data-bs-target="#terminosModal">términos y condiciones</a></label>
            </div>

            <!-- Botón de registro -->
            <button type="submit" class="btn btn-primary">Registrarme</button>
        </form>

        <!-- Modal de términos y condiciones -->
        <div class="modal fade" id="terminosModal" tabindex="-1" aria-labelledby="terminosModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="terminosModalLabel">Términos y condiciones</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Contenido de los términos y condiciones -->
                        <h5>Términos y Condiciones de Uso</h5>

                        <p>Por favor, lee detenidamente los siguientes términos y condiciones antes de utilizar nuestro servicio.</p>

                        <ol>
                            <li>
                                <strong>Aceptación de los Términos y Condiciones:</strong>
                                <p>Al acceder y utilizar este servicio, aceptas estar sujeto a estos términos y condiciones de uso. Si no estás de acuerdo con alguno de estos términos, por favor, no utilices el servicio.</p>
                            </li>
                            <li>
                                <strong>Uso Apropiado:</strong>
                                <p>Debes utilizar este servicio de manera adecuada y respetuosa. No debes utilizarlo para ningún propósito ilegal o que viole los derechos de otros.</p>
                            </li>
                            <li>
                                <strong>Propiedad Intelectual:</strong>
                                <p>Todos los derechos de propiedad intelectual del servicio y su contenido pertenecen a los propietarios del servicio. No tienes derecho a utilizarlos de ninguna manera sin autorización previa.</p>
                            </li>
                            <li>
                                <strong>Privacidad:</strong>
                                <p>Respetamos tu privacidad y nos comprometemos a proteger tus datos personales. Consulta nuestra política de privacidad para obtener más información sobre cómo utilizamos y protegemos tus datos.</p>
                            </li>
                            <li>
                                <strong>Modificaciones:</strong>
                                <p>Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Las modificaciones entrarán en vigencia inmediatamente después de su publicación en el servicio.</p>
                            </li>
                            <li>
                                <strong>Contacto:</strong>
                                <p>Si tienes alguna pregunta sobre estos términos y condiciones, contáctanos.</p>
                            </li>
                        </ol>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enlace para iniciar sesión -->
        <p class="mt-3">¿Ya tienes cuenta? <a href="{{ route('formulario-login') }}" style="text-decoration: none;">Iniciar sesión</a></p>
    </div >

<div class="h" style="margin-bottom: 80px;"></div>



</body>



</html>