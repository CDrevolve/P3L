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
        Schema::create('laporan_transaksi_penitips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penitip')->constrained('penitips');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->string('nama');
            $table->double('total_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_transaksi_penitips');
    }
};
