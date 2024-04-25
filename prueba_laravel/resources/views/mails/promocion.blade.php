<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promoción</title>
</head>

<body>
    <h3>¡Hola, {{ $usuario->name }}!</h3>

    <p>¡Gracias por registrarte en nuestro sitio! Queremos darte la bienvenida ofreciéndote nuestras últimas promociones.</p>

    @if ($products->isNotEmpty())
    <h3>Productos Recientes</h3>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; padding: 8px;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px;">Nombre del Producto</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;"><span style="color: darkgreen;">$</span>{{ $product->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif



    <p>No te pierdas nuestras increíbles ofertas. Visita nuestro sitio para obtener más detalles.</p>

    <p>¡Esperamos verte pronto!</p>

    <p>Atentamente,<br>
        Tu equipo de Altamar Shop</p>
</body>

</html>