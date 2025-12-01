<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pasien_id')
                ->constrained('pasien')
                ->cascadeOnDelete();

            $table->foreignId('poli_id')
                ->constrained('poli')
                ->cascadeOnDelete();

            $table->foreignId('dokter_id')
                ->constrained('dokter')
                ->cascadeOnDelete();

            $table->foreignId('penjamin_id')
                ->constrained('penjamin')
                ->cascadeOnDelete();

            // NOMOR ANTRIAN
            $table->integer('no_antrian');

            $table->date('tanggal_daftar');

            $table->string('keluhan')->nullable();

            $table->enum('status', ['Terdaftar', 'Dipanggil', 'Selesai'])
                ->default('Terdaftar');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
