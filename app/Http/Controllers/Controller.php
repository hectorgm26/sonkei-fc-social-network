<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // Mensajes personalizados para esta validación
    public $messages = [
        // Email = username
        'username.unique' => 'Este email ya está en uso. Por favor, elige otro.',
        'username.required' => 'El campo Email es obligatorio.',
        'username.min' => 'El Email debe tener al menos 8 caracteres.',
        'username.max' => 'El Email no puede tener más de 50 caracteres.',

        // Validacion para la contraseña
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.required' => 'El campo Contraseña es obligatorio.',

        // Validación para el RUT
        'rut.unique' => 'Este RUT ya está en uso.',
        'rut.required' => 'El campo RUT es obligatorio.',
        'rut.regex' => 'El formato del RUT es inválido. Ejemplo: 19704556-6 o 9258014-8.',

        // Otros campos
        'name.required' => 'El campo Nombre Completo es obligatorio.',
        'phone.required' => 'El campo Teléfono es obligatorio.',
        'commune.required' => 'El campo Comuna es obligatorio.',
        'position.required' => 'El campo Posición es obligatorio.',
        'profession.required' => 'El campo Profesión es obligatorio.',

    ];
}
