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
      $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
      $table->enum('name', ['Único', 'Básico', 'Pro', 'Empresarial']);
      $table->enum('type', ['mensual', 'anual', 'único']);
      $table->decimal('price', 10, 0)->default(0);
      $table->json('features')->nullable();
      $table->unsignedTinyInteger('discount')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('plans');
  }
};
