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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();

$table->string('plano');
$table->decimal('valor', 10, 2);

$table->string('payment_id')->nullable();
$table->string('status')->default('pendente');

$table->string('usuario')->nullable();
$table->string('senha')->nullable();

$table->timestamp('pago_em')->nullable();

$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
