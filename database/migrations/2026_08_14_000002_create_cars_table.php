<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->string('maker');
            $table->string('model');
            $table->unsignedSmallInteger('year');
            $table->enum('car_type', ['sedan','hatchback','suv'])->default('sedan');
            $table->enum('fuel_type', ['gasoline','diesel','electric','hybrid'])->default('gasoline');
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('mileage')->default(0);
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('cars'); }
};