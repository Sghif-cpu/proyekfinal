<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('dokter', function (Blueprint $table) {
    $table->id();
    $table->string('nama');

    $table->foreignId('poli_id')
          ->constrained('poli')
          ->cascadeOnDelete();

    $table->string('sip')->nullable();
    $table->string('no_hp')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
