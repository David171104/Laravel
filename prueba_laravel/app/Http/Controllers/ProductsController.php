<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB; //pdfs
use ZipArchive; //traer pdfs
use Illuminate\Support\Facades\Session;
use App\Models\Usuarios;

class ProductsController extends Controller
{
    /**
     * index para mostrar todos los elementos
     * store para guardar un producto
     * update para actualizar
     * destroy para eliminar un producto
     * edit para mostrar el formulario de edicion
     */

    public function index()
    {
        $produc = Product::all();
        return view('products.index1', compact('productos'));
    }
    public function index1()
    {

        $products = Product::paginate(10);
        $products = Product::orderBy('created_at', 'desc')->paginate(10);



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

        return view('products.index1', ['products' => $products, 'categories' => $categories, 'name' => $name]);
    }
    //

    public function insert(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|regex:/^[a-zA-Z\s]*$/', //'description' => 'required|alpha', permite ingresar letras en mayuscula y minuscula pero sin espacios en blanco
            'price' => 'required|numeric|min:0',
        ], [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.string' => 'El nombre del producto debe ser un texto.',
            'name.max' => 'El nombre del producto no puede tener más de :max caracteres.',
            'category_id.required' => 'La categoría del producto es obligatoria.',
            'category_id.exists' => 'La categoría seleccionada no es válida.',
            'description.regex' => 'La descripción del producto debe contener solo letras y espacios.',
            'price.required' => 'El precio del producto es obligatorio.',
            'price.numeric' => 'El precio del producto debe ser un número.',
            'price.min' => 'El precio del producto debe ser mayor o igual a :min.',
        ]);

        // Validar si ya existe un producto con el mismo nombre en la misma categoría
        $existingProduct = Product::where('name', $request->name)
            ->where('category_id', $request->category_id)
            ->exists();

        if ($existingProduct) {
            return redirect()->back()->with('error', 'Ya existe un producto con el mismo nombre en esta categoría.');
        }


        $producto = new Product;
        $producto->name = $request->name;
        $producto->category_id = $request->category_id;
        $producto->description = $request->description;
        // Limpiar el valor del precio antes de asignarlo al producto
        $cleanedPrice = $this->cleanPrice($request->price);
        $producto->price = $cleanedPrice;



        $producto->save();


        return redirect()->back()->with('success', 'El producto se ha creado exitosamente');
    }

    // Función para limpiar el precio
    private function cleanPrice($price)
    {
        // Convertir el precio a un formato numérico
        $numericPrice = (float) str_replace(['$', ','], ['', ''], $price);

        // Devolver el precio limpio
        return $numericPrice;
    }



    public function edit($id)
    {
        $products = Product::find($id);
        $categories = Category::all();

        return view('products.show', ['product' => $products, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        // Buscar el producto por su ID
        $producto = Product::find($id);
        $categories = Category::all();


        if ($producto) {

            $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'description' => 'required|regex:/^[a-zA-Z\s]*$/',
                'price' => 'required|numeric|min:0',
            ], [
                'name.required' => 'El nombre del producto es obligatorio.',
                'name.string' => 'El nombre del producto debe ser un texto.',
                'name.max' => 'El nombre del producto no puede tener más de :max caracteres.',
                'category_id.required' => 'La categoría del producto es obligatoria.',
                'category_id.exists' => 'La categoría seleccionada no es válida.',
                'description.regex' => 'La descripción del producto debe contener solo letras y espacios.',
                'price.required' => 'El precio del producto es obligatorio.',
                'price.numeric' => 'El precio del producto debe ser un número.',
                'price.min' => 'El precio del producto debe ser mayor o igual a :min.',
            ]);

            // Verificar si ya existe otro producto con el mismo nombre en la misma categoría
            $existingProduct = Product::where('name', $request->name)
                ->where('category_id', $request->category_id)
                ->where('id', '!=', $producto->id) // Excluir el producto actual
                ->exists();

            // Si existe un producto con el mismo nombre en la misma categoría, mostrar un mensaje de error
            if ($existingProduct) {
                return redirect()->back()->with('error', 'Ya existe un producto con el mismo nombre en esta categoría.');
            }






            $producto->name = $request->input('name');
            $producto->category_id = $request->input('category_id');
            $producto->description = $request->input('description');
            // Limpiar el valor del precio antes de asignarlo al producto
            $cleanedPrice = $this->cleanPrice($request->price);
            $producto->price = $cleanedPrice;


            $producto->save();
            return redirect()->back()->with('success', 'Producto editado correctamente')->with('categories', $categories);
        } else {

            return redirect()->back()->with('error', 'El producto no fue encontrado');
        }
    }



    public function destroy($id)
    {
        $producto = Product::find($id);
        if ($producto) {
            $producto->delete();
            Session::flash('success', 'Producto eliminado correctamente');
        } else {
            Session::flash('error', 'El producto no se pudo encontrar o ya ha sido eliminado');
        }
        return back();
    }


    public function mostrar_productos()
    {
        $products = Product::all();

        return view('users.index', ['products' => $products]);
    }


    /* public function buscarPorTermino(Request $request)
    {
        $termino = $request->input('buscar');


        $productos = Product::where('name', 'like', "%$termino%")->get();


        $categories = Category::all();


        return view('products.buscar', compact('productos', 'categories'));
    }

    public function buscarPorCategoria(Request $request)
    {
        $categoriaId = $request->input('categoria');

        if ($categoriaId) {
            $categoria = Category::find($categoriaId);
            $productos = $categoria->products;
        } else {
            $productos = Product::all();
        }

        $categories = Category::all();

        return view('products.buscar', compact('productos', 'categories'));
    }*/


    public function showDetails(Request $request, $id)
    {
        // Obtener los detalles del producto según el ID proporcionado
        $product = Product::find($id);

        // Verificar si el producto existe
        if (!$product) {
            abort(404); // Producto no encontrado
        }

        // Retornar la vista con el objeto $product
        return view('products.index1', ['product' => $product]);
    }


    public function filtrarProductos(Request $request)
    {

        $categoriaId = $request->input('categoria');


        $productos = Product::query();



        $userId = session('user_id');
        $usuario = Usuarios::find($userId);
        $name = $usuario->name;

        if ($categoriaId) {

            $productos->where('category_id', $categoriaId);
        }



        $filtros = $request->only([
            'name',
            'description',
            'price'
        ]);


        foreach ($filtros as $filtro => $valor) {
            if ($valor && in_array($filtro, ['name', 'description', 'price'])) {
                $productos->where($filtro, 'like', "%$valor%");
            }
        }


        $productos = $productos->get();


        $categories = Category::all();


        $filterValues = array_filter($filtros, function ($valor) {
            return $valor !== '';
        });


        if (!isset($filtros['categoria'])) {
            $filtros['categoria'] = null;
        }
        // Paginar los resultados
      

        return view('products.buscar', compact('productos', 'categories', 'filtros', 'filterValues', 'name'));
    }





    public function limpiarFiltros()
    {

        return redirect()->route('filtrar-producto');
    }



    public function comprarProducto($id)
    {
        $producto = Product::find($id);



        // Cambiar el estado del producto a "Vendido" (2)
        $producto->status = 2; // Vendido
        $producto->save();

        return redirect()->back()->with('success', 'Se ha comprado el producto con éxito.');
    }





    /*public function storePdf(Request $request, $productId)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:2048', // Validar el archivo PDF
        ]);

        $pdf = $request->file('pdf');

        // Actualizar solo la columna 'pdf' para el producto específico
        DB::table('products')
            ->where('id', $productId)
            ->update(['pdf' => $pdf->store('products')]);

        return redirect()->back()->with('success', 'Pdf importado correctamente');
    }*/



    /* public function storePdf(Request $request, $productId)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:2048', // Validar el archivo PDF
        ], [
            'pdf.required' => 'El archivo PDF es obligatorio.',
            'pdf.file' => 'El archivo adjuntado no es válido.',
            'pdf.mimes' => 'El archivo adjuntado debe ser de tipo PDF.',
            'pdf.max' => 'El tamaño del archivo PDF no debe ser mayor a :max kilobytes.',
        ]);

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');

            // Guardar el archivo PDF con un nombre específico
            $fileName = 'product_' . $productId . '_' . time() . '.' . $pdf->getClientOriginalExtension();
            $pdf->storeAs('products', $fileName);

            // Actualizar solo la columna 'pdf' para el producto específico
            DB::table('products')
                ->where('id', $productId)
                ->update(['pdf' => $fileName]);

            return redirect()->back()->with('success', 'Pdf importado correctamente');
        } else {
            return redirect()->back()->with('error', 'Por favor, seleccione un archivo PDF.');
        }
    }*/


    public function storePdf(Request $request, $productId)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:2048', // Validar el archivo PDF
        ], [
            'pdf.required' => 'El archivo PDF es obligatorio.',
            'pdf.file' => 'El archivo adjuntado no es válido.',
            'pdf.mimes' => 'El archivo adjuntado debe ser de tipo PDF.',
            'pdf.max' => 'El tamaño del archivo PDF no debe ser mayor a :max kilobytes.',
            'pdf.uploaded' => 'El archivo PDF no pudo ser cargado.',
        ]);

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');

            // Actualizar solo la columna 'pdf' para el producto específico
            DB::table('products')
                ->where('id', $productId)
                ->update(['pdf' => $pdf->store('products')]);

            return redirect()->back()->with('success', 'Pdf importado correctamente');
        } else {
            return redirect()->back()->with('error', 'Por favor, seleccione un archivo PDF.');
        }
    }


    public function downloadPdfs(Request $request)
    {
        $productIds = $request->input('products');
        $products = Product::find($productIds);

        $zipFileName = 'selected_pdfs.zip';
        $zip = new ZipArchive;
        $zip->open(storage_path('app/' . $zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($products as $product) {
            $pdfPath = storage_path('app/' . $product->pdf);
            $zip->addFile($pdfPath, $product->pdf);
        }

        $zip->close();

        return response()->download(storage_path('app/' . $zipFileName))->deleteFileAfterSend(true);
    }









    public function viewPdf($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->pdf) {
            // Si el producto tiene un PDF subido, mostrar el PDF
            return response()->file(storage_path('app/' . $product->pdf));
        } else {
            // Si el producto no tiene ningún PDF subido, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'El producto no tiene ningún PDF subido.');
        }
    }

    public function downloadPdf($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->pdf) {
            // Si el producto tiene un PDF subido, descargar el PDF
            $pdfPath = storage_path('app/' . $product->pdf);
            return response()->download($pdfPath);
        } else {
            // Si el producto no tiene ningún PDF subido, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'El producto no tiene ningún PDF subido.');
        }
    }
}
