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
        Schema::create('adjuntos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ruta');
            $table->foreignId('user_registra_id')->constrained('users');
            $table->bigInteger('paciente_id')->unsigned(false);
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreignId('tipo_adjuntos_id')->constrained('tipo_adjuntos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjuntos');
    }
};
