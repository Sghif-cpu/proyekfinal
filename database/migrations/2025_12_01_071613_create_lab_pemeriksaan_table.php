<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('lab_pemeriksaan', function (Blueprint $table) {
    $table->id();

    $table->foreignId('rekam_medis_id')
          ->constrained('rekam_medis')
          ->cascadeOnDelete();

    $table->string('nama_pemeriksaan');
    $table->string('hasil')->nullable();
    $table->string('satuan')->nullable();

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_pemeriksaan');
    }
};
