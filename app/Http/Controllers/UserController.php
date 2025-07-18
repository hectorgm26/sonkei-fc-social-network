<?php

namespace App\Http\Controllers;

use App\Models\User;  // Importar el modelo User
use Illuminate\Auth\Events\Registered;  // Opcional, si usas el evento Registered
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  // Importar la fachada Hash
use Illuminate\Validation\Rules\Password;  // Importar la clase Password

class UserController extends Controller
{
    public function showFormRegistro()
    {
        if (Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->with('success', 'Tiene una sesión iniciada, ciérrela para crear una nueva.');
        }

        $datos = [
            'textos' => [
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Registro Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese sus datos para registrarse en el sistema'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/users/registro', $datos);
    }

    public function guardarNuevo(Request $request)
    {
        // 1. revisar los datos que llegan del formulario
        // dd($request->all());

        // 2. Validación de los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'email', 'min:8', 'max:50', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],

            // Validación para el campo 'phone'
            'phone' => ['required', 'string', 'regex:/^\+56\d{9}$/', 'unique:' . User::class],

            // Validación para el campo 'wsp' (Whatsapp)
            'wsp' => ['nullable', 'string', 'regex:/^\+56\d{9}$/', 'unique:' . User::class],

            // Validación para el 'rut' (asegurándonos que sea único)
            'rut' => ['required', 'string', 'unique:' . User::class, 'regex:/^\d{7,8}-[0-9Kk]$/'],

            // Otros campos que no se mencionan directamente pero puedes agregar restricciones
            'commune' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255']
        ], $this->messages);

        // 3. Creación del nuevo usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'wsp' => $request->wsp,
            'rut' => $request->rut,
            'commune' => $request->commune,
            'position' => $request->position,
            'profession' => $request->profession,
        ]);

        // Opcional: Disparar el evento Registered si necesitas enviar correos de verificación, etc.
        // event(new Registered($user));

        // 4. Redirigir a la página de login con un mensaje de éxito
        return redirect()->route('/')->with('success', 'Usuario creado, debe iniciar sesión.');
    }

    public function showFormLogin()
    {
        $datos = [
            'textos' => [
                'titulo' => 'Iniciar Sesión | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Bienvenido a Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese Credenciales'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        if (Auth::check()) {
            // Si el usuario ya está autenticado, redirígelo a la página principal
            // o a su dashboard.
            return redirect()->route('/')->with('success', 'Tiene una sesión iniciada, ciérrela para iniciar una nueva.');
        }

        return view('backoffice/users/login', $datos);
    }

    public function login(Request $request)
    {
        // Paso 1: Validación de los datos del formulario - ahora se usara el rut para iniciar sesion
        $credentials = $request->validate([
            'rut' => ['required', 'string', 'regex:/^\d{7,8}-[0-9Kk]$/'],  // Validación del formato del RUT
            'password' => ['required'],
        ], $this->messages);

        // Paso 2: Buscar al usuario por el RUT
        $user = User::where('rut', $credentials['rut'])->first();

        // Paso 3: Verificar si el usuario existe y si la contraseña es correcta
        if ($user && Hash::check($request->password, $user->password)) {
            // Si las credenciales son correctas, autenticamos al usuario
            Auth::login($user);

            // Regenerar la sesión para prevenir ataques de secuestro de sesión
            $request->session()->regenerate();

            // Redirigir al dashboard con un mensaje de éxito
            return redirect()->route('dashboard')->with('success', "Bienvenido {$user->name}, sesión iniciada exitosamente.");
        }

        // Si no se encuentra el usuario o la contraseña es incorrecta, devolvemos un error
        return back()->withErrors([
            'rut' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('rut');
    }


    // CERRAR SESION
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('/')->with('success', 'Sesión cerrada exitosamente.');
    }

    // VER EL PERFIL DEL USUARIO AUTENTICADO
    public function profileUser()
    {
        if (!Auth::check()) {
            return redirect()->route('user.form.show.login')->with('error', 'Debes iniciar sesión para acceder.');
        }

        $user = Auth::user();

        return view('backoffice.users.profile.profile-user');
    }

    public function profileTeams()
    {
        if (!Auth::check()) {
            return redirect()->route('user.form.show.login')->with('error', 'Debes iniciar sesión para acceder.');
        }

        return view('backoffice.users.profile.profile-teams');
    }

    public function profileProjects()
    {
        if (!Auth::check()) {
            return redirect()->route('user.form.show.login')->with('error', 'Debes iniciar sesión para acceder.');
        }

        return view('backoffice.users.profile.profile-projects');
    }

    public function profileConnections()
    {
        if (!Auth::check()) {
            return redirect()->route('user.form.show.login')->with('error', 'Debes iniciar sesión para acceder.');
        }

        return view('backoffice.users.profile.profile-connections');
    }
}
