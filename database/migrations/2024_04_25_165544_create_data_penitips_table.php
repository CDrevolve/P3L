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
        Schema::create('data_penitips', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_produk')->constrained('produks');
            $table->string('nama');
            $table->string('alamat');
            $table->string('notelp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penitips');
    }
};
