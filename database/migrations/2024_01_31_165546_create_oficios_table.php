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
        Schema::create('oficios', function (Blueprint $table) {
            $table->id();
            $table->string('oficio', 50)->unique();
            $table->date('fecha_oficio');
            $table->foreignId('destinatario_id')->references('id')->on('destinatarios');
            $table->longText('asunto');
            $table->foreignId('remitente_id')->references('id')->on('remitentes');
            $table->foreignId('departamento_id')->references('id')->on('departamentos');
            $table->date('fecha_recepcion');
            $table->string('archivado_en')->nullable();
            $table->longText('seguimiento')->nullable();
            $table->string('imagen', 100)->nullable();
            $table->foreignId('status_oficios_id')->references('id')->on('status_oficios');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oficios');
    }
};
