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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_karyawan')->unique();
            // $table->string('foto')->nullable();
            $table->date('tanggal_masuk');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('jabatan_id')->constrained('jabatans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
