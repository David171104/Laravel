<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Usuarios;

class CarritoController extends Controller
{
    public function mostrarCarrito()
    {
        $userId = session('user_id');
        $user = Usuarios::find($userId);

        // Verificar si se encontró el usuario
        if ($user) {
            // Obtener el nombre del usuario
            $name = $user->name;
        } else {
            // Si no se encuentra el usuario, asignar un valor por defecto
            return view('login');
        }

        // Obtener los productos del carrito desde la sesión
        $productosCarrito = session()->get('carrito', []);

        // Verificar si la variable $productosCarrito contiene elementos
        if (!empty($productosCarrito)) {
            // Si hay elementos en el carrito, pasarlos a la vista junto con el nombre del usuario
            return view('users.carrito', ['productosCarrito' => $productosCarrito, 'name' => $name]);
        } else {
            // Si el carrito está vacío, simplemente pasar el nombre del usuario a la vista
            return view('users.carrito', ['name' => $name]);
        }
    }



    public function agregarAlCarrito(Request $request)
    {
        $productoId = $request->input('productId');
        $producto = Product::find($productoId);

        $carrito = session()->get('carrito');


        // Verificar si el producto ya está en el carrito
        if (!$carrito || !isset($carrito[$productoId])) {
            $carrito[$productoId] = [
                'producto' => $producto,
                'cantidad' => 1
            ];
        } else {
            // Incrementar la cantidad si el producto ya está en el carrito
            $carrito[$productoId]['cantidad']++;
        }

        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto añadido al carrito correctamente');
    }



    public function eliminarDelCarrito($id)
    {

        $carrito = session()->get('carrito');

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('success', 'Producto eliminado del   carrito correctamente');
    }

    public function aumentarCantidad($id)
    {

        $carrito = session()->get('carrito');

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
            session()->put('carrito', $carrito);
        }

        return redirect()->back();
    }

    public function disminuirCantidad($id)
    {

        $carrito = session()->get('carrito');

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']--;
            if ($carrito[$id]['cantidad'] === 0) {
                unset($carrito[$id]);
            }
            session()->put('carrito', $carrito);
        }

        return redirect()->back();
    }
}
