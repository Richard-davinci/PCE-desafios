<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::dropIfExists('plans');

    Schema::create('plans', function (Blueprint $table) {
      $table->id();
      $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
      $table->enum('name', ['Básico', 'Pro', 'Empresarial']);
      $table->enum('type', ['mensual', 'anual', 'único']);
      $table->decimal('price', 10, 0);
      $table->json('features')->nullable();
      $table->timestamps();
      $table->unique(['service_id', 'name', 'type'], 'plans_service_name_type_unique');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('plans');
  }
};
