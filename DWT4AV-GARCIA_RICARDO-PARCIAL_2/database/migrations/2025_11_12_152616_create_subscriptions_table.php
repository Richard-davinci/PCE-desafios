<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('subscriptions', function (Blueprint $table) {
      $table->id();

      // Relaciones
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->foreignId('service_id')->constrained()->cascadeOnDelete();
      $table->foreignId('plan_id')->constrained()->cascadeOnDelete();

      // Snapshot de precio mostrado en la pre-vista (opcional pero útil)
      $table->decimal('price', 10, 2)->nullable();

      // Estado simple para este MVP
      // Sugeridos: 'activa', 'pausada', 'cancelada', 'vencida'
      $table->string('status', 20)->default('activa');

      // Fechas relevantes (usadas por el listado)
      $table->timestamp('started_at')->nullable();
      $table->timestamp('next_renewal_at')->nullable();
      $table->timestamp('canceled_at')->nullable();

      $table->timestamps();

      // Para evitar duplicados exactos (mismo user/servicio/plan) si quisieras
      // $table->unique(['user_id', 'service_id', 'plan_id']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('subscriptions');
  }
};
