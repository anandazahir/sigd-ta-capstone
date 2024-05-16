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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->string('kasir')->nullable();
            $table->string('metode')->nullable();
            $table->string('status_cetak_spk')->nullable();
            $table->foreignId('penghubung_id')->constrained('penghubungs')->onDelete('cascade')->nullable();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
