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
        Schema::create('sub_kriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->integer('min_value')->nullable(); // misal: 0
            $table->integer('max_value')->nullable(); // misal: 15
            $table->integer('bobot'); // misal: 1.0
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_kriterias');
    }
};
