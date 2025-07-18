<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del usuario
            $table->string('rut')->unique(); // Rut del usuario
            $table->string('username')->unique(); // Correo electrónico del usuario
            $table->string('phone')->unique(); // Telefono del usuario
            $table->string('wsp')->unique(); // Whatsapp del usuario (puede ser distinto al telefono)
            $table->string('commune'); // Comuna del usuario
            $table->string('position'); // Posicion en el campo de futbol del usuario
            $table->string('profession'); // Profesion del usuario
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); // contrasenia
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
