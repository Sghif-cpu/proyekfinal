<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('penjamin', function (Blueprint $table) {
    $table->id();
    $table->string('nama_penjamin');
    $table->string('tipe');
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('penjamin');
    }
};
