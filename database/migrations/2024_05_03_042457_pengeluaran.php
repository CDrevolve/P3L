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
        //
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_bahanbaku')->constrained('bahan_bakus');
            $table->string('nama');
            $table->string('jumlah');
            $table->double('harga');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('pengeluaran');
    }
};
