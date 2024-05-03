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
            $table->foreignId('id_resep')->constrained('reseps');
            // $table->foreignId('id_penitip')->constrained('penitips')->nullable();
            $table->foreignId('id_jenis')->constrained('jenis');
            $table->string('nama');
            $table->integer('stok');
            $table->integer('harga');
            $table->integer('kuota_harian');
            // $table->double('lebihan');
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
