<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // Mensajes personalizados para esta validación
    public $messages = [
        'username.unique' => 'Este nombre de usuario (email) ya está en uso. Por favor, elige otro.',
        // Puedes añadir más mensajes específicos si lo necesitas, por ejemplo:
        'username.required' => 'El campo Nombre de Usuario es obligatorio.',

        "username.min" => "El nombre de usuario debe tener al menos 8 caracteres.",
        "username.max" => "El nombre de usuario no puede tener más de 50 caracteres.",

        


        

    ];
}
