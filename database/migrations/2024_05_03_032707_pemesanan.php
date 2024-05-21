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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_customer')->constrained('customers');
            $table->foreignId('id_karyawan')->constrained('karyawans');
            $table->string('nama');
            $table->string('isi');
            $table->double('harga');
            $table->string('pickup');
            $table->date('tanggal');
            $table->string('status');
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
