<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('category', 100);
            $table->string('status', 20)->default('Activo');
            $table->string('subtitle', 150)->nullable();
            $table->text('description');
            $table->json('conditions')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('thumb_image')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
