<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
</head>
<body>
    <h1>Recuperar Contraseña</h1>
    
    <form action="{{ route('enviar-codigo') }}" method="POST">
        @csrf
        
        <h2>Selecciona una opción para recibir el código de recuperación:</h2>
        
        <input type="radio" id="sms" name="opcion" value="sms">
        <label for="sms">Enviar mensaje de texto SMS al celular XXXXXX</label><br>
        
        <input type="radio" id="email" name="opcion" value="email">
        <label for="email">Enviar correo electrónico al @usergmail.com</label><br>
        
        <button type="submit">Enviar Código</button>
    </form>

    <!-- Mensaje de éxito o error -->
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @elseif(session('error'))
        <div>{{ session('error') }}</div>
    @endif
</body>
</html>