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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi')->unique();
            $table->string('jenis_kegiatan');
            $table->string('no_do')->unique();
            $table->date('tanggal_DO_rilis');
            $table->date('tanggal_DO_exp');
            $table->string('perusahaan');
            $table->integer('jumlah_petikemas');
            $table->string('kapal');
            $table->string('emkl');
            $table->date('tanggal_transaksi')->nullable();
            $table->string('kasir')->nullable();
            $table->string('inventory');
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->string('status_pembayaran');
            $table->string('status_cetak_spk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
