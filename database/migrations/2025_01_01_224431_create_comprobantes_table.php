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
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_comprobante')->unique(); // Número de comprobante único
            $table->enum('banco', ['Banco Pichincha', 'Banco Pacifico']); // Nombre del banco como atributo con opciones limitadas
            $table->decimal('monto', 10, 2); // Monto de la transferencia
            $table->date('fecha_transferencia'); // Fecha de la transferencia
            $table->enum('tipo_transaccion', ['Retiro', 'Deposito']); // Tipo de transacción con opciones limitadas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobantes');
    }
};
