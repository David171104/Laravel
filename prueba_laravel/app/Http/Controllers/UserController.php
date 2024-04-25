<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Usuarios; // Importa el modelo Usuarios
use App\Mail\EnviarCorreo;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {

        $usuario = auth()->user();


        if ($usuario) {

            return view('users.index', ['user' => $usuario]);
        } else {

            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver esta página');
        }
    }

    public function show()
    {

        $user = auth()->user();
        return view('perfil-usuario', ['user' => $user]);
    }

    public function edit()
    {

        $usuario = auth()->user();
        return view('editar-perfil', ['usuarios' => $usuario]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . auth()->id(), // Corrige 'users' por 'usuarios'

        ]);


        $usuario = auth()->user();
        $usuario->name = $request->name;
        $usuario->email = $request->email;



        return redirect()->route('perfil-usuario')->with('success', 'Datos actualizados correctamente');
    }






    //return view('users.index', ['products' => $products, 'categories' => $categories]);



    public function indexusuarios(Request $request)
    {
        $userId = session('user_id');


        $user = Usuarios::find($userId);


        if ($user) {

            $name = $user->name;
        } else {

            return view('login');
        }


        $categoriaId = $request->input('categoria');


        $productos = Product::query();

        if ($categoriaId) {
            $productos->where('category_id', $categoriaId);
        }


        $productos = $productos->get();


        $categories = Category::all();


        return view('users.index', compact('productos', 'categories', 'name'));
    }



    /* public function indexusuarios(Request $request)
    {
        // Recuperar el ID de la categoría seleccionada
        $categoriaId = $request->input('categoria');

        // Filtrar los productos por categoría si se seleccionó una
        $productos = Product::query();

        if ($categoriaId) {
            $productos->where('category_id', $categoriaId);
        }

        // Obtener la lista final de productos después de aplicar los filtros
        $productos = $productos->get();

        // Recuperar todas las categorías para el campo de selección
        $categories = Category::all();

        // Retornar vista con los productos filtrados y las categorías
        return view('users.index', compact('productos', 'categories'));
    }*/
    // Define la función para generar el código de recuperación


    private function generarCodigoRecuperacion()
    {
        return mt_rand(100000, 999999); // Genera un número aleatorio de 6 dígitos
    }




    public function enviarCorreo(Request $request)
    {

        $email = $request->input('email');



        $request->validate(['email' => 'required|email']);


        $codigoRecuperacion = $this->generarCodigoRecuperacion();
        $user = Usuarios::where('email', $email)->first();
        if (!empty($user)) {

            session(['user_id' => $user->id]);
        }

        if (empty($user)) {
            return redirect()->back()->with('error', 'El correo electrónico proporcionado no está registrado.');
        }

        session(['codigo_recuperacion' => $codigoRecuperacion]);

        if (!empty($email)) {

            Mail::send('mails.recuperar-contrasena', ['codigoRecuperacion' => $codigoRecuperacion], function ($message) use ($email) {
                $message->from('dfree5288@gmail.com', 'Altamar shop')
                    ->to($email)
                    ->subject('Recuperar Contraseña');
            });
        } else {
            return redirect()->back()->with('error', 'El correo electrónico proporcionado no está registrado.');
        }


        if (count(Mail::failures()) > 0) {
            return redirect()->back()->with('error', 'El correo electrónico proporcionado no está registrado.');
        }

        return back()->with('success', 'Se ha enviado un correo electrónico para recuperar la contraseña.');
    }


    public function enviarCorreoPrueba()
    {
        Mail::raw('Mensaje de prueba', function ($message) {
            $message->from('dfree5288@gmail.com', 'Altamar Shop')
                ->to('altamardavid8@gmail.com')
                ->subject('Prueba de correo');
        });
    }




    public function verificarCodigo(Request $request)
    {
        $codigoIngresado = $request->input('codigo');
        $codigoRecuperacionEnviado = session('codigo_recuperacion'); // Recuperar el código enviado por correo electrónico

        if ($codigoIngresado == $codigoRecuperacionEnviado) {

            return redirect()->route('contraseña')->with('success', 'El codigo suministrado es correcto.');
        } else {

            return redirect()->back()->with('error', 'El código ingresado no es válido. Por favor, inténtelo de nuevo.');
        }
    }


    /*public function actualizarContrasena(Request $request,$email)
    {
        // Verificar si el correo electrónico existe en la base de datos
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('formulario-login')->with('error', 'No se encontró ningún usuario con ese correo electrónico.');
        }

        // Verificar si la contraseña actual es válida
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password_confirmation' => 'La contraseña actual es incorrecta.']);
        }

        // Actualizar la contraseña del usuario
        $user->password = Hash::make($request->password);
        $user->save();

        // Inicar sesión con el usuario y redirigir a la página de inicio de sesión
        Auth::login($user);

        return redirect()->route('formulario-login')->with('success', 'Contraseña actualizada exitosamente.');
    }*/


    /* public function actualizarContrasena(Request $request)
    {
        // Obtener el ID de usuario desde la sesión
        $userId = session('user_id');

        // Obtener el usuario correspondiente al ID de usuario
        $user = Usuarios::find($userId);

        // Validar los datos del formulario
        $request->validate([
            'password' => 'required|min:3',
            'password_confirmation' => 'required|min:3|same:password',
        ], [
            'password_confirmation.same' => 'Las contraseñas no son iguales',
            'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos :min caracteres',
        ]);

        // Verificar si la contraseña actual es correcta
        if (!Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->password_confirmation);
            $user->save();
            return redirect()->route('formulario-login')->with('success', 'Contraseña actualizada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Las contraseñas no son iguales');
        }
    }*/

    public function actualizarContrasena(Request $request)
    {

        $userId = session('user_id');


        $user = Usuarios::find($userId);

        $request->validate([
            'password' => 'required|min:3',
            'password_confirmation' => 'required|min:3|same:password',
        ], [
            'password.required' => 'El campo de la contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password_confirmation.required' => 'El campo de confirmación de la contraseña es obligatorio.',
            'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos :min caracteres.',
            'password_confirmation.same' => 'Las contraseñas no coinciden.',
        ]);



        if (!Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->password_confirmation);
            $user->save();
            return redirect()->route('formulario-login')->with('success', 'Contraseña actualizada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Las contraseñas no son iguales');
        }
    }



    public function editar()
    {
        $userId = session('user_id');
        $user = Usuarios::find($userId);


        if ($user) {
            $name = $user->name;
            return view('users.editar-perfil', compact('user', 'name'));
        } else {
            return view('login');
        }
    }




    public function actualizarPerfil(Request $request)
    {
        $userId = session('user_id');
        $user = Usuarios::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'No se encontró al usuario.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'telefono' => 'nullable|regex:/^\+?\d{10}$/|numeric',
            'pais' => 'required', // Asegurarse de que el campo pais esté presente
        ], [
            'email.unique' => 'El correo electrónico ya está siendo utilizado por otro usuario.',
            'telefono.regex' => 'El número de teléfono debe contener exactamente diez dígitos.',
            'telefono.numeric' => 'El número de teléfono debe ser un valor numérico.',
        ]);

        if ($request->filled('email') && $request->input('email') !== $user->email) {
            $existingUser = Usuarios::where('email', $request->input('email'))->where('id', '!=', $user->id)->first();
            if ($existingUser) {
                return redirect()->route('perfil.editar')->with('error', 'El correo electrónico ya está siendo utilizado por otro usuario');
            }
        }

        $oldData = [
            'name' => $user->name,
            'email' => $user->email,
            
        ];

        if ($user) {
            $telefonoCompleto = $request->filled('telefono') && $request->filled('pais') ? $request->pais . $request->telefono : null;
            $user->update($request->only('name', 'email') + ['telefono' => $telefonoCompleto]);

            if ($user->name) {
                Mail::send('mails.actualizacionperfilusuario', ['user' => $user, 'oldData' => $oldData], function ($message) use ($user) {
                    $message->from('dfree5288@gmail.com', 'Altamar Shop')
                        ->to($user->email)
                        ->subject('Actualizacion de perfil');
                });
            }

            return redirect()->back()->with('success', 'Perfil actualizado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el perfil. Por favor, intenta nuevamente.');
        }
    }




    /* SIN NOTIFICACION DE ACTUALIZACION DEL USUARIO public function actualizarPerfil(Request $request)
    {
        $userId = session('user_id'); // Obtener el usuario autenticado
        $user = Usuarios::find($userId);



        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Otras reglas de validación para otros campos del perfil
        ], [
            'email.unique' => 'El correo electrónico ya está siendo utilizado por otro usuario.',
        ]);

        try {
            // Actualizar los datos del perfil del usuario
            $user->update($request->only('name', 'email'));

            return redirect()->back()->with('success', 'Perfil actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el perfil. Por favor, intenta nuevamente.');
        }
    }*/





    ///////////////////BORRAR CUENTA PERFIL USUARIO


    /*

 <!-- Formulario para eliminar la cuenta -->
    <form action="{{ route('perfil.eliminar') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.');">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger mt-3">Eliminar Cuenta</button>
    </form>



    */


    public function mostrarPerfilUsuario()
    {
        $userId = session('user_id');
        $user = Usuarios::find($userId);


        if ($user) {
            $name = $user->name;
            return view('users.configuracion', compact('user', 'name'));
        } else {
            return view('login');
        }
    }




    public function eliminarCuenta(Request $request)
    {
        $userId = session('user_id');
        $user = Usuarios::find($userId);


        if ($user) {

            $user->delete();


            Session::flash('success', 'Cuenta eliminada correctamente');
        } else {

            Session::flash('error', 'Hubo un error al eliminar la cuenta');
        }

        //return view('login');
        return view('principal');
    }





    public function editaradmin()
    {
        $userId = session('user_id');
        $usuario = Usuarios::find($userId);
        // Definir un array de países con sus códigos


        /*

          $paises = [
            ['codigo' => '+57', 'nombre' => 'Colombia'],
            ['codigo' => '+1', 'nombre' => 'Estados Unidos'],
            ['codigo' => '+44', 'nombre' => 'Reino Unido'],
            ['codigo' => '+52', 'nombre' => 'México'],
            ['codigo' => '+34', 'nombre' => 'España'],
            // Agrega más países según sea necesario
        ];

        */

        if ($usuario) {
            $name = $usuario->name;

            return view('products.editar-perfil-admin', compact('usuario', 'name'));
        } else {
            return view('login');
        }
    }

    public function actualizarPerfiladmin(Request $request)
    {
        $userId = session('user_id');
        $usuario = Usuarios::find($userId);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'telefono' => 'nullable|regex:/^\+?\d{10}$/|numeric',
            'pais' => 'required', // Asegurarse de que el campo pais esté presente
        ], [
            'email.unique' => 'El correo electrónico ya está siendo utilizado por otro usuario.',
            'telefono.regex' => 'El número de teléfono debe contener exactamente diez dígitos.',
            'telefono.numeric' => 'El número de teléfono debe ser un valor numérico.',
        ]);

        if ($request->filled('email') && $request->input('email') !== $usuario->email) {
            $existingUser = Usuarios::where('email', $request->input('email'))->where('id', '!=', $usuario->id)->first();
            if ($existingUser) {
                return redirect()->route('perfil.editaradmin')->with('error', 'El correo electrónico ya está siendo utilizado por otro usuario');
            }
        }

        try {
            $telefonoCompleto = $request->pais . $request->telefono;
            $usuario->telefono = $telefonoCompleto;
            $usuario->update($request->only('name', 'email') + ['telefono' => $telefonoCompleto]);
            //$usuario->update($request->only('name', 'email', $telefonoCompleto));
            return redirect()->back()->with('success', 'Perfil actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el perfil. Por favor, intenta nuevamente.');
        }
    }

    /*Sin el campo de telefono public function actualizarPerfiladmin(Request $request)
    {
        $userId = session('user_id');
        $usuario = Usuarios::find($userId);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,

        ], [
            'email.unique' => 'El correo electrónico ya está siendo utilizado por otro usuario.',
        ]);

        if ($request->filled('email') && $request->input('email') !== $usuario->email) {

            $existingUser = Usuarios::where('email', $request->input('email'))->where('id', '!=', $usuario->id)->first();
            if ($existingUser) {
                return redirect()->route('perfil.editaradmin')->with('error', 'El correo electrónico ya está siendo utilizado por otro usuario');
            }
        }

        try {

            $usuario->update($request->only('name', 'email'));

            return redirect()->back()->with('success', 'Perfil actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el perfil. Por favor, intenta nuevamente.');
        }
    }*/

    /*public function actualizarPerfiladmin(Request $request)
{
    $userId = session('user_id'); // Obtener el usuario autenticado
    $usuario = Usuarios::find($userId);

    // Verificar si el usuario existe
    if (!$usuario) {
        return redirect()->back()->with('error', 'El usuario no se encontró. Por favor, intenta nuevamente.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
        // Otras reglas de validación para otros campos del perfil
    ], [
        'email.unique' => 'El correo electrónico ya está siendo utilizado por otro usuario.',
    ]);

   

    if ($usuario) {
           $usuario->update($request->only('name', 'email'));
        // Si la actualización fue exitosa, redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Perfil actualizado exitosamente');
    } else {
        // Si hubo un problema con la actualización, redirigir con un mensaje de error
        return redirect()->back()->with('error', 'Hubo un problema al actualizar el perfil. Por favor, intenta nuevamente.');
    }
}*/


    public function editarusuarios()
    {
        $userId = session('user_id');
        $usuario = Usuarios::find($userId);


        if ($usuario) {
            $name = $usuario->name;
            return view('products.editar-usuarios', compact('usuario', 'name'));
        } else {
            return view('login');
        }
    }



    public function buscarusuario(Request $request)
    {
        $nombreUsuario = $request->input('nombre_usuario');
        $usuarioEncontrado = Usuarios::where('name', $nombreUsuario)->first();

        if ($usuarioEncontrado) {
            $userId = session('user_id');
            $user = Usuarios::find($userId);

            $name = $user->name;
            return view('products.editar-usuarios')->with(['usuario' => $usuarioEncontrado, 'name' => $name]);
        } else {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
    }


    //return view('products.editar-usuarios', compact('usuario', 'name'));


    public function limpiarFiltros()
    {
        // Redirigir a la misma página sin ningún parámetro de filtro
        return redirect()->route('perfil.editarusuarios');
    }




    public function actualizarusuario(Request $request)
    {
        $usuarioId = $request->input('usuario_id');
        $usuario = Usuarios::find($usuarioId);



        if ($usuario) {


            $request->validate([
                'telefono' => 'nullable|regex:/^\+?\d{10}$/|numeric',
                'pais' => 'required', // Asegurarse de que el campo pais esté presente
            ], [
                'telefono.regex' => 'El número de teléfono debe contener exactamente diez dígitos.',
                'telefono.numeric' => 'El número de teléfono debe ser un valor numérico.',
                'pais.required' => 'Por favor, selecciona el país.',
            ]);

            if ($request->filled('newPassword')) {

                if (Hash::check($request->input('currentPassword'), $usuario->password)) {

                    $newPassword = Hash::make($request->input('newPassword'));


                    $usuario->password = $newPassword;


                    $usuario->save();


                    Mail::send('mails.adminnuevacontraseña', ['name' => $usuario->name, 'newPassword' => $request->input('newPassword')], function ($message) use ($usuario) {
                        $message->from('dfree5288@gmail.com', 'Altamar Shop')
                            ->to($usuario->email)
                            ->subject('Cambio de contraseña');
                    });

                    return redirect()->route('perfil.editarusuarios')->with('success', 'Contraseña actualizada exitosamente y se ha enviado al usuario.');
                } else {
                    return redirect()->back()->with('error', 'La contraseña actual es incorrecta.');
                }
            }


            $usuario->name = $request->input('nombre');

            if ($request->filled('email') && $request->input('email') !== $usuario->email) {

                $existingUser = Usuarios::where('email', $request->input('email'))->where('id', '!=', $usuario->id)->first();
                if ($existingUser) {
                    return redirect()->route('perfil.editarusuarios')->with('error', 'El correo electrónico ya está siendo utilizado por otro usuario');
                }
                $usuario->email = $request->input('email');
            }

            if ($request->filled('telefono')) {


                $telefonoCompleto = $request->pais . $request->telefono;
                $usuario->telefono = $telefonoCompleto;
            }


            $usuario->save();

            return redirect()->route('perfil.editarusuarios')->with('success', 'Usuario actualizado correctamente.');
        } else {
            return redirect()->route('perfil.editarusuarios')->with('error', 'Usuario no encontrado');
        }
    }











    /* public function actualizarusuario(Request $request)
    {
        // Implementa la lógica para actualizar la información del usuario
        // Por ejemplo:
        $usuarioId = $request->input('usuario_id');
        $usuario = Usuarios::find($usuarioId);



        if ($usuario) {
            $usuario->name = $request->input('nombre');
            $usuario->email = $request->input('email');
            // Agrega aquí la actualización de otros campos del usuario si es necesario
            $usuario->update($request->only('name', 'email'));

            return redirect()->route('perfil.editarusuarios')->with('success', 'Usuario actualizado correctamente');
        } else {
           
            return redirect()->route('perfil.editarusuarios')->with('error', 'Usuario no encontrado');
        }
    }*/
}
