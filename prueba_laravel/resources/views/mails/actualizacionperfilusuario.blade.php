<!DOCTYPE html>
<html>

<head>
    <title>Perfil Actualizado</title>

    <style>
        ul {
            list-style: none;
            padding: 0;
        }

        li {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <p>Hemos recibido la solicitud de actualización de tu perfil. Aquí están los detalles actualizados:</p>
    <ul>
        @if ($oldData['name'] !== $user->name)
        <li><strong>Nombre:</strong> {{ $user->name }}</li>
        @endif
        @if ($oldData['email'] !== $user->email)
        <li><strong>Email:</strong> {{ $user->email }}</li>
        @endif
        <!-- Otros campos que puedan ser actualizados -->
    </ul>
</body>

</html>