<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('transaksi', function (Blueprint $table) {
    $table->id();

    $table->foreignId('pendaftaran_id')
          ->constrained('pendaftaran')
          ->cascadeOnDelete();

    $table->decimal('total', 12, 2);
    $table->enum('status', ['belum_dibayar','sudah_dibayar'])->default('belum_dibayar');

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
