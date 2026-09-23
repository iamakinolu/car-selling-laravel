<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('car_images', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('car_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->unsignedInteger('position')->default(1);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('car_images'); }
};