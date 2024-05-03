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
        Schema::create('detail_produks', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_produk')->constrained('produks');
            $table->foreignId('id_bahan_baku')->constrained('bahan_bakus');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('detail_produks');
    }
};
