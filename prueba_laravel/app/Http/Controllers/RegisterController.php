<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Auth\Events\Registered;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Mail\EnviarCorreo;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CodigoRecuperacionNotification;
use Exception;
use Illuminate\Notifications\Facades\Vonage as FacadesVonage;
use Illuminate\Support\Facades\Vonage;
use Twilio\Rest\Messaging\V1;
use Vonage\Client\Credentials\Basic;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class RegisterController extends Controller
{
    public function mostrarFormularioRegistro()
    {
        return view('register');
    }

    private function generarCodigoRecuperacion()
    {
        return mt_rand(100000, 999999); // Genera un número aleatorio de 6 dígitos
    }
    // ->line(line:'este es el saludo')
    //->action(text:'Notification Action', url(path:'/'));        Boton con Redireccion




    /*  $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'terminos' => 'required|accepted',
        ], [
            'name.regex' => 'El nombre solo puede contener letras.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'terminos.accepted' => 'Debes aceptar los términos y condiciones.',
            'telefono.regex' => 'El campo  de teléfono solo puede contener números.',
        ]);

    */

   

/*
public function registrarUsuario(Request $request)
{
    // Registrar al usuario
    $usuario = new Usuarios;
    $usuario->name = $request->name;
    $usuario->email = $request->email;
    $usuario->password = Hash::make($request->password);
    $usuario->rol = 2; // Por defecto, establece el rol en 2
    // Concatenar el prefijo del país con el número de teléfono
    $telefonoCompleto = $request->pais . $request->telefono;
    $usuario->telefono = $telefonoCompleto;

    $usuario->save();

    // Generar código de verificación
    $codigoVerificacion = $this->generarCodigoRecuperacion();

    // Configurar el cliente Guzzle
    $client = new Client(['verify' => 'C:\xampp\htdocs\prueba_laravel\cacert\cacert.pem']);

    try {
        // Realizar la solicitud HTTP para enviar el SMS
        $response = $client->request('POST', 'https://api103.hablame.co/api/sms/v3/send/priority', [
            'json' => [
                'toNumber' => '573183388286',
                'sms' => 'SMS de prueba Hablame',
                'flash' => '0',
                'sc' => '890202',
                'request_dlvr_rcpt' => '0',
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Account' => '10027896',
                'ApiKey' => 'jymM5G0N7x5SkZYfl7rEBzzxuXZz7h',
                'Content-Type' => 'application/json',
                'Token' => '12d821c4d31f48a2aad9875891339112', // Token proporcionado por Habla
            ],
        ]);

        // Verificar si la solicitud fue exitosa
        if ($response->getStatusCode() === 200) {
            // Realizar otras operaciones si es necesario
            return response()->json(['message' => 'Operación exitosa'], 200);
        } else {
            return response()->json(['error' => 'Hubo un error en la solicitud'], $response->getStatusCode());
        }
    } catch (ClientException $e) {
        // Manejar excepciones de cliente (por ejemplo, errores 4xx)
        $response = $e->getResponse();
        $responseBodyAsString = $response->getBody()->getContents();
        return response()->json(['error' => $responseBodyAsString], $response->getStatusCode());
    } catch (ServerException $e) {
        // Manejar excepciones de servidor (por ejemplo, errores 5xx)
        $response = $e->getResponse();
        $responseBodyAsString = $response->getBody()->getContents();
        return response()->json(['error' => $responseBodyAsString],$response->getStatusCode());
    } catch (\Symfony\Component\ErrorHandler\Error\FatalError $e) {
        // Manejar la excepción de tiempo de ejecución
        return response()->json(['error' => 'Se ha excedido el tiempo de ejecución'], 500);
    } catch (\Exception $e) {
        // Manejar otras excepciones
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

*/



public function registrarUsuario(Request $request)
{
    $request->validate([
        'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'email' => 'required|string|email|max:255|unique:users', // Verifica si el correo electrónico ya está registrado
        'password' => 'required|string|min:3',
        'terminos' => 'required|accepted', // Nueva regla de validación para términos y condiciones
        'telefono' => 'required|string|regex:/^\d+$/',
    ], [
        'name.regex' => 'El nombre solo puede contener letras.',
        'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        'terminos.accepted' => 'Debes aceptar los términos y condiciones.', // Mensaje personalizado de error
    ]);

    try {
        // Registrar al usuario
        $usuario = new Usuarios;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->rol = 2; // Por defecto, establece el rol en 2
        $telefonoCompleto = $request->pais . $request->telefono;
        $usuario->telefono = $telefonoCompleto;
        $usuario->save();

        // Generar código de verificación
        $codigoVerificacion = $this->generarCodigoRecuperacion();

        // Configurar el cliente Guzzle
        $client = new Client(['verify' => 'C:\xampp\htdocs\prueba_laravel\cacert\cacert.pem']);

        // Realizar la solicitud HTTP para enviar el SMS
        $response = $client->request('POST', 'https://api103.hablame.co/api/sms/v3/send/priority', [
            'json' => [
                'toNumber' => $usuario->telefono,
                'sms' => "Hola {$usuario->name}, ¡Gracias por registrarte en Altamar Shop!, para completar tu registro, ingresa el siguiente código de verificación de la cuenta {$codigoVerificacion}",
                'flash' => '0',
                'sc' => '890202',
                'request_dlvr_rcpt' => '0',
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Account' => '10027896',
                'ApiKey' => 'jymM5G0N7x5SkZYfl7rEBzzxuXZz7h',
                'Content-Type' => 'application/json',
                'Token' => '12d821c4d31f48a2aad9875891339112', // Token proporcionado por Habla
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            // Enviar correo electrónico de bienvenida con el código de verificación
            Mail::send('mails.bienvenido', ['name' => $usuario->name, 'codigoVerificacion' => $codigoVerificacion], function ($message) use ($usuario) {
                $message->from('dfree5288@gmail.com', 'Altamar Shop')
                    ->to($usuario->email)
                    ->subject('¡Bienvenido a Altamar Shop!');
            });

            // Redirigir de vuelta con un mensaje de éxito
            return back()->withInput()->with('success', 'Usuario registrado correctamente. Se ha enviado un correo electrónico y un mensaje de texto de bienvenida con instrucciones.');
        } else {
            return back()->withInput()->with('error', 'Hubo un error al enviar el mensaje de texto');
        }
    } catch (\Illuminate\Database\QueryException $ex) {
        // Captura la excepción de la restricción de integridad (correo duplicado)
        if ($ex->errorInfo[1] == 1062) { // El código de error 1062 indica una violación de la restricción de integridad
            throw ValidationException::withMessages(['email' => 'El correo electrónico ya está siendo utilizado por otro usuario.']);
        } else {
            // Maneja otros errores de base de datos aquí si es necesario
            throw $ex;
        }
    } catch (ClientException $e) {
        // Manejar excepciones de cliente (por ejemplo, errores 4xx)
        $response = $e->getResponse();
        $responseBodyAsString = $response->getBody()->getContents();
        return response()->json(['error' => $responseBodyAsString], $response->getStatusCode());
    } catch (ServerException $e) {
        // Manejar excepciones de servidor (por ejemplo, errores 5xx)
        $response = $e->getResponse();
        $responseBodyAsString = $response->getBody()->getContents();
        return response()->json(['error' => $responseBodyAsString],$response->getStatusCode());
    } catch (\Symfony\Component\ErrorHandler\Error\FatalError $e) {
        // Manejar la excepción de tiempo de ejecución
        return response()->json(['error' => 'Se ha excedido el tiempo de ejecución'], 500);
    } catch (\Exception $e) {
        // Manejar otras excepciones
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


/*public function registrarUsuario(Request $request)
{
    // Registrar al usuario
    $usuario = new Usuarios;
    $usuario->name = $request->name;
    $usuario->email = $request->email;
    $usuario->password = Hash::make($request->password);
    $usuario->rol = 2; // Por defecto, establece el rol en 2
    // Concatenar el prefijo del país con el número de teléfono
    $telefonoCompleto = $request->pais . $request->telefono;
    $usuario->telefono = $telefonoCompleto;

    $usuario->save();

    // Generar código de verificación
    $codigoVerificacion = $this->generarCodigoRecuperacion();

    // Configurar el cliente Guzzle
    $client = new Client(['verify' => 'C:\xampp\htdocs\prueba_laravel\cacert\cacert.pem']);
    $mensaje = "Hola {$usuario->name}, ¡Gracias por registrarte en Altamar Shop!, para completar tu registro, ingresa el siguiente código de verificación de la cuenta {$codigoVerificacion}";
    try {
        // Realizar la solicitud HTTP para enviar el SMS
        $response = $client->request('POST', 'https://api103.hablame.co/api/sms/v3/send/priority', [
            'json' => [
                'toNumber' => '573183388286',
                'sms' => $mensaje,
                'flash' => '0',
                'sc' => '890202',
                'request_dlvr_rcpt' => '0',
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Account' => '10027896',
                'ApiKey' => 'jymM5G0N7x5SkZYfl7rEBzzxuXZz7h',
                'Content-Type' => 'application/json',
                'Token' => '12d821c4d31f48a2aad9875891339112', // Token proporcionado por Habla
            ],
        ]);

        // Verificar si la solicitud fue exitosa
        if ($response->getStatusCode() === 200) {
            // Realizar otras operaciones si es necesario
            return response()->json(['message' => 'Operación exitosa'], 200);
        } else {
            return response()->json(['error' => 'Hubo un error en la solicitud'], $response->getStatusCode());
        }
    } catch (ClientException $e) {
        // Manejar excepciones de cliente (por ejemplo, errores 4xx)
        $response = $e->getResponse();
        $responseBodyAsString = $response->getBody()->getContents();
        return response()->json(['error' => $responseBodyAsString], $response->getStatusCode());
    } catch (ServerException $e) {
        // Manejar excepciones de servidor (por ejemplo, errores 5xx)
        $response = $e->getResponse();
        $responseBodyAsString = $response->getBody()->getContents();
        return response()->json(['error' => $responseBodyAsString],$response->getStatusCode());
    } catch (\Symfony\Component\ErrorHandler\Error\FatalError $e) {
        // Manejar la excepción de tiempo de ejecución
        return response()->json(['error' => 'Se ha excedido el tiempo de ejecución'], 500);
    } catch (\Exception $e) {
        // Manejar otras excepciones
        return response()->json(['error' => $e->getMessage()], 500);
    }
}*/










    public function enviarCodigoVonage(Request $request)
    {

        $usuario = new Usuarios;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->rol = 2;
        $usuario->telefono = $request->pais . $request->telefono;
        $codigoVerificacion = $this->generarCodigoRecuperacion();

        $response = FacadesVonage::message()->send([
            'to' => $usuario->telefono,
            'from' => 'NOMBRE_REMITENTE',
            'text' => 'Tu código de verificación es: ' . $codigoVerificacion
        ]);

        return $response;
    }



    public function notificaciones()
    {
        $userId = session('user_id');
        $usuario = Usuarios::find($userId);

        // Verificar si se encontró el usuario
        if ($usuario) {
            $name = $usuario->name;
            return view('products.notificaciones', compact('usuario', 'name'));
        } else {
            return view('login');
        }
    }


    /*public function enviarCorreoPromocion()
    {
        // Obtener los usuarios que se registraron hace al menos dos horas
        $usuarios = Usuarios::where('fecha_registro', '<=', Carbon::now()->subHours(2))->get();

        foreach ($usuarios as $usuario) {
            // Enviar correo de promoción
            Mail::send('mails.promocion', ['usuario' => $usuario], function ($message) use ($usuario) {
                $message->from('dfree5288@gmail.com', 'Tu Nombre')
                    ->to($usuario->email)
                    ->subject('¡Descubre nuestras promociones!');
            });
        }
        return back()->withInput()->with('success', 'Correos de promoción enviados correctamente.');
    
       
    }*/


    public function enviarCorreoPromocion()
    {
        // Obtener la fecha actual
        $fechaActual = Carbon::now();


        $fechaLimite = $fechaActual->copy()->subHours(2);

        // Verificar si hay usuarios que se registraron hoy
        $usuariosHoy = Usuarios::whereDate('created_at', $fechaActual->toDateString())->exists();


        $usuariosRecientes = Usuarios::where('created_at', '<=', $fechaLimite)->exists();

        if ($usuariosHoy && $usuariosRecientes) {

            $usuarios = Usuarios::whereDate('created_at', $fechaActual->toDateString())
                ->where('created_at', '<=', $fechaLimite)
                ->get();


            $products = Product::orderBy('created_at', 'desc')->get();
            foreach ($usuarios as $usuario) {

                Mail::send('mails.promocion', ['usuario' => $usuario, 'products' => $products], function ($message) use ($usuario) {
                    $message->from('dfree5288@gmail.com', 'Altamar Shop')
                        ->to($usuario->email)
                        ->subject('¡Descubre nuestras promociones!');
                });
            }


            return back()->withInput()->with('success', 'Correos de promoción enviados correctamente.');
        } else {

            return back()->withInput()->with('error', 'No se encontraron usuarios nuevos hoy que lleven dos horas registrados.');
        }
    }

    // $usuarios = Usuarios::where('created_at', '<=', Carbon::now()->subMinutes(10))->get();
    //CORREOS DE PROMOCION QUE SE ENVIAN A TODOS LOS USUARIOS QUE TENGAN MAS DE DOS HORAS DE HABERSE REGISTRADO
    /* public function enviarCorreoPromocion()
    {
        // Obtener los usuarios que se registraron hace exactamente 10 minutos
        $usuarios = Usuarios::where('created_at', '<=', Carbon::now()->subHours(2))->get();
        $products = Product::orderBy('created_at', 'desc')->get();
        foreach ($usuarios as $usuario) {
            // Enviar correo de promoción


            Mail::send('mails.promocion', ['usuario' => $usuario, 'products' => $products], function ($message) use ($usuario) {
                $message->from('dfree5288@gmail.com', 'Altamar Shop')
                    ->to($usuario->email)
                    ->subject('¡Descubre nuestras promociones!');
            });
        }

        // Mensaje de éxito
        return back()->withInput()->with('success', 'Correos de promoción enviados correctamente.');
    }*/

    /*public function registrarUsuario(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Verifica si el correo electrónico ya está registrado
            'password' => 'required|string|min:3',
            'terminos' => 'required|accepted', // Nueva regla de validación para términos y condiciones
        ], [
            
            'terminos.accepted' => 'Debes aceptar los términos y condiciones.', // Mensaje personalizado de error
        ]);

        try {
            $usuario = new Usuarios;
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->rol = 2; // Por defecto, establece el rol en 2

            $usuario->save();

            return back()->withInput()->with('success', 'Usuario registrado correctamente');
        } catch (\Illuminate\Database\QueryException $ex) {
            // Captura la excepción de la restricción de integridad (correo duplicado)
            if ($ex->errorInfo[1] == 1062) { // El código de error 1062 indica una violación de la restricción de integridad
                throw ValidationException::withMessages(['email' => 'El usuario ya se encuentra registrado']);
            } else {
                // Maneja otros errores de base de datos aquí si es necesario
                throw $ex;
            }
        }
    }*/



















    /* public function registrarUsuario(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
            'terminos' => 'required|accepted', // Nueva regla de validación para términos y condiciones
        ], [
            
            'terminos.accepted' => 'Debes aceptar los términos y condiciones.', // Mensaje personalizado de error
        ]);

        $usuario = new Usuarios;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->rol = 2; // Establecer el valor predeterminado del rol

        $usuario->save();

        return back()->withInput()->with('success', 'Usuario registrado correctamente');
    }*/

    public function mostrarFormularioLogin()
    {
        return view('login');
    }
    public function Autenticar(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $usuario = Usuarios::where('email', $email)->first();

        if (!empty($usuario)) {
            // Almacenar el ID de usuario en la sesión
            session(['user_id' => $usuario->id]);
        }
        if ($usuario) {
            if (Hash::check($password, $usuario->password)) {
                if ($usuario->rol == 1) {
                    return redirect()->route('products.index1');
                } elseif ($usuario->rol == 2) {
                    return redirect()->route('users.index');
                }
            } else {
                return back()->withErrors(['email' => 'El usuario o la contraseña es incorrecto']);
            }
        } else {
            return back()->withErrors(['email' => 'El email proporcionado no está registrado en nuestro sistema.']);
        }
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('barra-navegacion');
    }
}
