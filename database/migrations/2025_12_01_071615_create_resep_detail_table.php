<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('resep_detail', function (Blueprint $table) {
    $table->id();

    $table->foreignId('resep_id')
          ->constrained('resep')
          ->cascadeOnDelete();

    $table->foreignId('obat_id')
          ->constrained('obat')
          ->cascadeOnDelete();

    $table->integer('jumlah');
    $table->string('dosis');

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('resep_detail');
    }
};
