<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignIdColumnDefinition;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('produks', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_jenis')->constrained('jenis');
            $table->foreignId('id_penitip')->constrained('penitips')->nullable();
            $table->string('nama');
            $table->double('stok');
            $table->double('harga');
            $table->integer('kuota_harian');
            $table->string('foto');
            $table->integer('kuota_harian_terpakai')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('produks');
    }
};
