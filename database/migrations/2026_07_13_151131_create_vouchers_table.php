<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {

            $table->id();

            $table->foreignId('hotspot_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('codigo')->unique();
            $table->string('perfil');
            $table->decimal('valor', 10, 2);

            $table->string('cliente_ip')->nullable();
            $table->string('mac')->nullable();

            $table->enum('status', [
                'pendente',
                'pago',
                'utilizado',
                'cancelado'
            ])->default('pendente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};