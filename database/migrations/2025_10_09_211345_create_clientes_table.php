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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->foreignId('vendedor_id')->constrained('users')->onDelete('cascade'); // relação com users
            $table->string('dominio')->nullable();
            $table->string('plataforma')->nullable();
            $table->json('servicos')->nullable(); // multiselect → armazenado como JSON
            $table->string('plano')->nullable();
            $table->string('status')->default('ativo');
            $table->string('email')->nullable();
            $table->string('servidor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
