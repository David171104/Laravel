<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Usuarios;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $userId = session('user_id');

        // Buscar el usuario en la base de datos
        $user = Usuarios::find($userId);

        // Verificar si se encontró el usuario
        if ($user) {
            // Pasar el nombre del usuario a la vista
            $name = $user->name;
        } else {
            // Si no se encuentra el usuario, asignar un valor por defecto
            return view('login');
        }

        return view('categories.index', ['categories' => $categories, 'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'color' => 'required|max:7',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'El nombre ya se encuentra en uso, escoja otro nombre por favor.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'color.required' => 'El color es obligatorio.',
            'color.max' => 'El color no puede tener más de 7 caracteres.',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->back()->with('success', 'Categoria creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $userId = session('user_id');

        // Buscar el usuario en la base de datos
        $user = Usuarios::find($userId);

        // Verificar si se encontró el usuario
        if ($user) {
            // Pasar el nombre del usuario a la vista
            $name = $user->name;
        } else {
            // Si no se encuentra el usuario, asignar un valor por defecto
            return view('login');
        }

        return view('categories.show', ['category' => $category, 'name' => $name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Buscar la categoría por su ID
        $category = Category::find($id);

        // Verificar si se encontró la categoría
        if ($category) {
            // Validar los datos del formulario
            $request->validate([
                'name' => 'required|unique:categories,name,' . $category->id . '|max:255',
                'color' => 'required|max:7',
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'name.unique' => 'El nombre ya está en uso.',
                'name.max' => 'El nombre no puede tener más de 255 caracteres.',
                'color.required' => 'El color es obligatorio.',
                'color.max' => 'El color no puede tener más de 7 caracteres.',
            ]);

            // Actualizar los atributos de la categoría con los datos del formulario
            $category->name = $request->input('name');
            $category->color = $request->input('color');

            // Guardar los cambios en la base de datos
            $category->save();

            // Redirigir a una vista o realizar otra acción (aquí se redirige a la lista de productos)
            return redirect()->back()->with('success', 'Categoría editada correctamente');
        } else {
            // Si no se encuentra la categoría, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'Hubo un error al editar la categoría');
        }
    }



    public function updatecategory(Request $request, $id)
    {
        // Buscar el producto por su ID
        $producto = Product::find($id);
        $categories = Category::all();

        if ($producto) {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|regex:/^[a-zA-Z\s]*$/',
                'price' => 'required|numeric|min:0',
            ], [
                'name.required' => 'El nombre del producto es obligatorio.',
                'name.string' => 'El nombre del producto debe ser un texto.',
                'name.max' => 'El nombre del producto no puede tener más de :max caracteres.',
                'description.regex' => 'La descripción del producto debe contener solo letras y espacios.',
                'price.required' => 'El precio del producto es obligatorio.',
                'price.numeric' => 'El precio del producto debe ser un número.',
                'price.min' => 'El precio del producto debe ser mayor o igual a :min.',
            ]);
            // Obtener el nombre del producto del formulario
            $nombreProducto = $request->input('name');

            // Verificar si existe otro producto con el mismo nombre en la misma categoría
            $productoExistente = Product::where('name', $nombreProducto)
                ->where('category_id', $producto->category_id) // Filtrar por la misma categoría
                ->where('id', '!=', $producto->id) // Excluir el producto actual
                ->first();

            // Si existe un producto con el mismo nombre en la misma categoría, muestra un mensaje de error
            if ($productoExistente) {
                return redirect()->back()->with('error', 'Ya existe un producto con el mismo nombre en esta categoría');
            }

            // Si no hay otro producto con el mismo nombre en la misma categoría, actualiza el producto actual
            $producto->name = $nombreProducto;
            $producto->description = $request->input('description');
            // Limpiar el valor del precio antes de asignarlo al producto
            $cleanedPrice = $this->cleanPrice($request->price);
            $producto->price = $cleanedPrice;
            $producto->save();

            return redirect()->back()->with('success', 'Producto editado correctamente')->with('categories', $categories);
        } else {
            return redirect()->back()->with('error', 'Ha ocurrido un error al editar el producto. Por favor, inténtalo de nuevo más tarde.');
        }
    }
    // Función para limpiar el precio
    private function cleanPrice($price)
    {
        // Convertir el precio a un formato numérico
        $numericPrice = (float) str_replace(['$', ','], ['', ''], $price);

        // Devolver el precio limpio
        return $numericPrice;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        // esto es para que al eliminar la categoria se eliminen todos los productos que tengan esta categoria
        $category->products()->each(function ($products) {
            $products->delete();
        });
        $category->delete();

        return redirect()->back()->with('error', 'Categoria Eliminada');
    }
}
