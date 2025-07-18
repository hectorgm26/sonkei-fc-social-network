# Sonkei FC Social Network

## Descripción

**Sonkei FC Social Network** es una plataforma interna diseñada para facilitar la comunicación y gestión de actividades dentro de *Sonkei FC*, un equipo de fútbol. Este proyecto es parte del ramo **Desarrollo de Software 1** del *Instituto Profesional San Sebastián*.

El sistema está construido utilizando el framework **Laravel 12** y utiliza **SQLite** como base de datos. La plataforma incluye vistas dinámicas y utiliza el template **Vuexy** (versión Bootstrap) para proporcionar una interfaz moderna y amigable.

## Tecnologías utilizadas

* **Backend**: Laravel 12
* **Base de Datos**: SQLite
* **Frontend**: Template Vuexy (versión Bootstrap)
* **Autenticación**: No se utiliza middleware para autenticación.
* **Entorno de Desarrollo**: Firebase Studio - IDE online que configura automáticamente el entorno de desarrollo
* **Otros**: HTML, CSS, JavaScript, Blade (vistas), Bootstrap

## Instalación

### Opción 1: Instalación Local

#### Requisitos previos

1. **PHP** versión 8.1 o superior.
2. **Composer** para gestionar las dependencias de PHP.
3. **SQLite** para la base de datos.
4. **Node.js** y **NPM** para la gestión de dependencias del frontend.

#### Pasos para instalar el proyecto

1. Clona el repositorio:

```bash
git clone https://github.com/hectorgm26/sonkei-fc-social-network.git
```

2. Accede a la carpeta del proyecto:

```bash
cd sonkei-fc-social-network
```

3. Instala las dependencias de PHP usando Composer:

```bash
composer install
```

4. Configura el archivo `.env`:
   
   Copia el archivo `.env.example` a `.env`:

```bash
cp .env.example .env
```

   Luego, asegúrate de que la configuración de la base de datos esté configurada para usar SQLite, como se muestra a continuación:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database/database.sqlite
```

5. Genera la clave de la aplicación Laravel:

```bash
php artisan key:generate
```

6. Instala las dependencias de Node.js:

```bash
npm install
```

7. Compila los activos del frontend:

```bash
npm run dev
```

8. Ejecuta las migraciones de la base de datos (si tienes alguna tabla de base de datos ya definida):

```bash
php artisan migrate
```

9. Ahora puedes ejecutar el servidor local de desarrollo:

```bash
php artisan serve
```

Abre tu navegador y accede a `http://localhost:8000` para ver la aplicación en funcionamiento.

### Opción 2: Desarrollo con Firebase Studio (Recomendado)

**Firebase Studio** es un IDE online que configura automáticamente el entorno de desarrollo, eliminando la necesidad de instalar PHP, Composer, Node.js y otras dependencias en tu equipo local.

#### Ventajas de usar Firebase Studio:

* **Configuración automática**: El entorno se configura automáticamente sin necesidad de instalaciones manuales
* **Sin dependencias locales**: No necesitas instalar PHP, Composer, Node.js, ni SQLite en tu PC
* **Acceso desde cualquier lugar**: Puedes trabajar desde cualquier dispositivo con conexión a internet
* **Colaboración en tiempo real**: Facilita el trabajo en equipo

#### Pasos para usar Firebase Studio:

1. Accede a Firebase Studio desde tu navegador
2. Crea un nuevo proyecto o importa el repositorio existente
3. El entorno se configurará automáticamente con todas las dependencias necesarias
4. Comienza a desarrollar inmediatamente sin configuración adicional

## Características

* **Gestión de usuarios**: Permite la creación de cuentas para los miembros del equipo.
* **Comunicaciones internas**: Facilita la interacción entre los miembros del equipo a través de mensajes.
* **Gestión de actividades**: Permite registrar eventos y actividades relacionadas con el equipo.
* **Interfaz amigable**: Se utiliza el template **Vuexy** (versión Bootstrap) para ofrecer una experiencia moderna y funcional.

## Contribuciones

Las contribuciones son bienvenidas. Si deseas colaborar, sigue estos pasos:

1. Haz un *fork* del repositorio.
2. Crea una rama con una descripción clara del cambio (por ejemplo: `feature/nueva-funcionalidad`).
3. Haz un *pull request* describiendo los cambios realizados.

## Licencia

Este proyecto está licenciado bajo la licencia MIT.
