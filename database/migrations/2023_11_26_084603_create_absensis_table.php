<?php

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Enums\StatusAbsen;
use App\Models\Matkul;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Dosen::class)->constrained();
            $table->foreignIdFor(Matkul::class)->constrained();
            $table->foreignIdFor(Kelas::class)->constrained();
            $table->dateTime('waktu_absen');
            $table->enum('status_absen', [StatusAbsen::TEPAT_WAKTU, StatusAbsen::TELAT, StatusAbsen::LEBIH_AWAL]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
