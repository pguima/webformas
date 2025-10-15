<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('type')->default('Web'); // Tipo de usuário
            $table->string('cpf', 14)->nullable()->unique(); // CPF formatado com pontos e traço
            $table->string('whatsapp', 20)->nullable(); // Número do WhatsApp
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['type', 'cpf', 'whatsapp']);
        });
    }

};
