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
        Schema::create("detail_tanggal", function (Blueprint $table){
            $table->id();
            $table->integer('kouta_terpakai');
            $table->foreignId('id_tanggal')->constrained('tanggals');
            $table->foreignId('id_pemesanan')->constrained('pemesanans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
