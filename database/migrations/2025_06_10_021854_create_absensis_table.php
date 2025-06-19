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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade');
            $table->foreignId('jadwal_kerja_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('izin_id')->nullable()->constrained()->onDelete('set null');
            $table->date('tanggal');
            $table->enum('shift', ['pagi', 'malam']);
            $table->time('jam_absen');
            $table->enum('status', ['tepat waktu', 'terlambat', 'izin']);
            $table->time('keterlambatan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * 2025_06_10_021853
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
