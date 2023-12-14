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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->datetime('Fecha_inicio');
            $table->datetime('fecha_creacion');
            $table->dateTime('fecha_termino');
            $table->string('descripcion');
            $table->unsignedBigInteger('idEstado');
            $table->foreign('idEstado')->references('id')->on('estados')->onDelete('cascade');
            $table->unsignedBigInteger('idCreador');
            $table->foreign('idCreador')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
