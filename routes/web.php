<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing/index');
})->name('/');

Route::get('/backoffice/login', [UserController::class, 'showFormLogin'])->name('user.form.show.login');
Route::post('/backoffice/login', [UserController::class, 'login'])->name('user.form.login');

// Ruta para mostrar el dashboard
Route::get('/backoffice/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('user.form.show.login')->with('error', 'Debes iniciar sesión para acceder.');
    }
    return view('landing/dashboard');
})->name('dashboard');

// Ruta para la vista del perfil de usuario
Route::get('/backoffice/users/profile/user', [UserController::class, 'profileUser'])->name('profile.user');

// Ruta para la vista de equipos
Route::get('/backoffice/users/profile/teams', [UserController::class, 'profileTeams'])->name('profile.teams');

// Ruta para la vista de proyectos
Route::get('/backoffice/users/profile/projects', [UserController::class, 'profileProjects'])->name('profile.projects');

// Ruta para la vista de conexiones
Route::get('/backoffice/users/profile/connections', [UserController::class, 'profileConnections'])->name('profile.connections');

// Rutas para la creacion de un usuario
Route::get('/backoffice/create-user', [UserController::class, 'showFormRegistro'])->name('user.form.show.registro');
Route::post('/backoffice/create-user', [UserController::class, 'guardarNuevo'])->name('user.form.registro');

// Ruta para cerrar sesión
Route::post('/backoffice/logout', [UserController::class, 'logout'])->name('logout');

