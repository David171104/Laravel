<?php
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Mail\EnviarCorreo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba', 'ProductsController@index');



Route::get('/produ', 'ProductsController@index1');


Route::get('/barra-navegacion', function () {
   
    return view('principal');
})->name('barra-navegacion');


Route::get('/ingresar_productos', function () {
    return view('products/index1');
});

Route::post('/crear_productos', [ProductsController::class, 'insert'])->name('crear_productos');

Route::get('/producto-creado', function () {
    return "Producto creado exitosamente";
})->name('producto-creado');



Route::get('/editar-productos/{id}', [ProductsController::class, 'edit'])->name('editar-productos');//mostrar elemento individualmente
Route::get('/producto-editado', function () {
    return "Producto editado exitosamente";
})->name('producto-editado');

Route::patch('/actualizar-productos/{id}', [ProductsController::class, 'update'])->name('actualizar-productos');

Route::delete('/destroy-productos/{id}', [ProductsController::class, 'destroy'])->name('destroy-productos');
Route::get('/producto-eliminado', function () {
    return "Producto eliminado exitosamente";
})->name('producto-eliminado');


Route::get('/products/{id}', [ProductsController::class, 'show'])->name('products.show');


Route::get('/ver-pdf/{id}', 'UserController@viewPdf')->name('ver-pdf');



Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');

Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}', [CategoriesController::class, 'show'])->name('categories.show');

Route::get('/categoria-editada', function () {
    return "Categoria editado exitosamente";
})->name('categoria-editada');

Route::patch('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');

//Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');

Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');




Route::get('/carrito', 'CarritoController@mostrarCarrito')->name('carrito');

Route::post('/agregar-carrito/{id}', [CarritoController::class, 'agregarAlCarrito'])->name('agregar-carrito');

//Route::post('/agregar-carrito/{id}', 'CarritoController@agregarAlCarrito')->name('agregar-carrito');

Route::get('/producto-añadido', function () {
    return "Producto añadido al carrito exitosamente";
})->name('producto-añadido');

Route::delete('/eliminar-carrito/{id}', 'CarritoController@eliminarDelCarrito')->name('eliminar-carrito');

Route::get('/producto-eliminado', function () {
    return "Producto eliminado del carrito exitosamente";
})->name('producto-eliminado');

Route::post('/aumentar-cantidad/{id}', 'CarritoController@aumentarCantidad')->name('aumentar-cantidad');

Route::post('/disminuir-cantidad/{id}', 'CarritoController@disminuirCantidad')->name('disminuir-cantidad');


Route::get('/mostrar-productos', 'ProductsController@mostrar_productos')->name('mostrar-productos');



/////////////////////////////////////////////////////
// Ruta para mostrar el formulario de registro
Route::get('/registro', [RegisterController::class, 'mostrarFormularioRegistro'])->name('formulario-registro');

// Ruta para procesar el formulario de registro
Route::post('/registro-usuario', [RegisterController::class, 'registrarUsuario'])->name('registro-usuario');

// Ruta para la página de éxito después del registro
Route::get('/registro-exitoso', function () {
    return 'Usuario registrado exitosamente';
})->name('registro-exitoso');

Route::get('/login', [RegisterController::class, 'mostrarFormularioLogin'])->name('formulario-login');

Route::post('/ingresar', [RegisterController::class, 'Autenticar'])->name('ingresar');
Route::get('/products', [ProductsController::class, 'index1'])->name('products.index1');
//Route::get('/users', [ProductsController::class, 'mostrar_productos'])->name('users.index');
Route::get('/users', [UserController::class, 'indexusuarios'])->name('users.index');

Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');


//////////////////////Filtrar producto
/*Route::get('/filtrar-producto', 'ProductsController@buscarPorTermino')->name('filtrar-producto');*/
Route::get('/buscar-por-categoria', 'ProductsController@buscarPorCategoria')->name('buscar-por-categoria');

Route::get('/filtrar-producto', 'ProductsController@filtrarProductos')->name('filtrar-producto');
Route::get('/limpiar-filtros', 'ProductsController@limpiarFiltros')->name('limpiar-filtros');

////////// comprar 
Route::post('/comprar-producto/{id}', 'ProductsController@comprarProducto')->name('comprar-producto');

Route::get('/producto-comprado', function () {
    return 'Se ha comprado el producto con éxito.';
})->name('producto-comprado');



Route::post('/products/{id}/storePdf', 'ProductsController@storePdf')->name('products.storePdf');
Route::get('/pdf-importado', function () {
    return 'Se ha importado el pdf exitosamente.';
})->name('pdf-importado');

// Define la ruta para mostrar los detalles del producto
Route::get('/product/{id}/details', 'ProductsController@showDetails')->name('product.details');

Route::get('/detalles-productos/{id}', [ProductsController::class, 'edit'])->name('detalles-productos');
Route::post('/exportar-pdf', 'ProductsController@downloadPdfs')->name('exportar-pdf');

Route::get('/products/{productId}/downloadPdf', 'ProductsController@downloadPdf')->name('download-pdf');


Route::get('/ver-pdf/{id}', 'ProductsController@viewPdf')->name('ver-pdf');




Route::post('/editar-producto-categories', [CategoriesController::class, 'updatecategory'])->name('editar-producto-categories');

Route::post('/editar-producto-categories/{producto_id}/{categoria_id}', [CategoriesController::class, 'updatecategory'])->name('editar-producto-categories');


///////////////////////////users
//Route::get('/perfil-usuario', [UserController::class, 'index'])->name('perfil-usuario');

//Route::get('/editar-perfil', [UserController::class, 'edit'])->name('editar-perfil');
//Route::post('/actualizar-perfil', [UserController::class, 'update'])->name('actualizar-perfil');



///////////////enviar correo para restablecer contraseña
Route::get('/olvidaste-contrasena', function () {
    return view('mails.enviar-correo');
})->name('olvidaste.contrasena');

Route::get('/verificar-cod-get', function () {
    return view('mails.verificar-codigo');
})->name('verificar-cod-get');


Route::get('/contraseña', function () {
    return view('mails.nueva-contrasena');
})->name('contraseña');


Route::post('enviar-correo', [UserController::class, 'enviarCorreo'])->name('enviar-correo');

Route::get('/enviar-correo-prueba', [UserController::class, 'enviarCorreoPrueba'])->name('enviar-correo-prueba');

Route::post('/verificar-codigo', [UserController::class, 'verificarCodigo'])->name('verificar-codigo');

Route::post('actualizar-contrasena', [UserController::class, 'actualizarContrasena'])->name('actualizar-contrasena');


/*Route::get('send-email', function () {
    $data = [
        'title' => 'Welcome to our website!',
        'body' => 'Thank you for visiting our website. We hope you find it helpful.'
    ];

    Mail::to('user@example.com')->send(new EnviarCorreo($data));

    return 'Email sent!';
});*/
Route::get('/perfil/editar', 'UserController@editar')->name('perfil.editar');


Route::put('/perfil/actualizar', 'UserController@actualizarPerfil')->name('perfil.actualizar');

Route::middleware('auth')->group(function () {
    // Tus rutas protegidas que requieren autenticación
});


Route::get('/perfil/editaradmin', 'UserController@editaradmin')->name('perfil.editaradmin');


Route::put('/perfil/actualizaradmin', 'UserController@actualizarPerfiladmin')->name('perfil.actualizaradmin');



//Route::get('/perfil/editarusuarios', 'UserController@editarusuarios')->name('perfil.editarusuarios');


//Route::put('/perfil/actualizarusuarios', 'UserController@actualizarPerfiladmin')->name('perfil.actualizarusuarios');

Route::get('/perfil/editarusuarios', 'UserController@editarusuarios')->name('perfil.editarusuarios');
Route::get('/perfil/buscarusuarios', 'UserController@buscarusuario')->name('perfil.buscarusuarios');
Route::post('/perfil/actualizarusuarios', 'UserController@actualizarusuario')->name('perfil.actualizarusuarios');

Route::get('/perfil/limpiarfiltros', 'UserController@limpiarFiltros')->name('perfil.limpiarFiltros');


Route::get('/perfil/notificaciones', 'RegisterController@notificaciones')->name('perfil.notificaciones');
Route::get('/enviar-promociones', 'RegisterController@enviarCorreoPromocion')->name('enviar.promociones');





// usuario eliminar cuenta
Route::get('/perfil', [UserController::class, 'mostrarPerfilUsuario'])->name('perfil.mostrar');
Route::delete('/perfil/eliminar', [UserController::class, 'eliminarCuenta'])->name('perfil.eliminar');
/*Route::middleware(['auth'])->group(function () {
    // Rutas para la edición y actualización del perfil
    Route::get('/perfil/editar', [UserController::class, 'editar'])->name('perfil.editar');
    Route::put('/perfil/actualizar', [UserController::class, 'actualizarPerfil'])->name('perfil.actualizar');
});*/

Route::get('/send-sms',[RegisterController::class, 'registrarUsuario'] )->name('send.sms');