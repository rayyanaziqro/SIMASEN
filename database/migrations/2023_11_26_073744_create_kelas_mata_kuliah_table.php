<?php

use App\Models\Kelas;
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
        Schema::create('kelas_mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kelas::class)->constrained();
            $table->foreignIdFor(Matkul::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_mata_kuliah');
    }
};
