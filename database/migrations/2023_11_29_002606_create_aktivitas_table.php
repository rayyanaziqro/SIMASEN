<?php

use App\Models\Dosen;
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
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Dosen::class)->constrained();
            $table->dateTime('waktu');
            $table->string('jenis_aktivitas');
            $table->string('deskripsi')->nullable();
            $table->boolean('status_verifikasi')->default(false);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
