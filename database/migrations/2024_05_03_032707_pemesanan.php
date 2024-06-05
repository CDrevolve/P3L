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
            $table->foreignId('id_alamat')->constrained('alamats');
            $table->string('nama');
            $table->string('isi');
            $table->double('harga');
            $table->string('pickup');
            $table->date('tanggal');
            $table->int('jarak')->nullable();
            $table->string('status');
            $table->integer('jarak');
            $table->double('ongkir')->default(0);
            $table->double('tips')->default(0);
            $table->string('no_nota');
            $table->string('bukti_pembayaran')->nullable();
            $table->int('poin')->default(0);
            $table->string('no_nota')->unique()->after('id');
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
