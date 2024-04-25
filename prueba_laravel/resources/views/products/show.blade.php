<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <title>Lista de Productos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    a {
      text-decoration: none;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 12px;
      /* Ajusta el padding para más espacio */
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;


    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding-top: 10px; padding-bottom: 10px;">
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
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex">
          @csrf
          <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary">Cerrar sesión <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
              <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
            </svg></button>
        </form>
      </div>
    </div>
  </nav>

  <!--Es una directiva que me pone un espacio-->
  @yield('content')

  <div class="container w-25 border p-4 mt-4">
    <form method="POST" action="{{ route('actualizar-productos', ['id'=> $product->id ]) }}">
      @method('PATCH')
      @csrf

      @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif

      @if ($errors->has('name') || $errors->has('description') || $errors->has('price'))
      <div class="alert alert-danger">
        @if ($errors->has('name'))
        <p>{{ $errors->first('name') }}</p>
        @endif
        @if ($errors->has('description'))
        <p>{{ $errors->first('description') }}</p>
        @endif
        @if ($errors->has('price'))
        <p>{{ $errors->first('price') }}</p>
        @endif
      </div>
      @endif
      <div class="mb-3">
        <label for="name" class="form-label">Nombre Producto</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
      </div>
      <div class="mb-3">
        <label for="category_id" class="form-label">Categoría del producto</label>
        <select name="category_id" class="form-select">
          @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <input type="text" class="form-control" name="description" id="description" value="{{ $product->description }}">
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ $product->price }}">
      </div>

      <button type="submit" class="btn btn-primary">Actualizar producto</button>
    </form>
  </div>



  </div>






</body>

</html>