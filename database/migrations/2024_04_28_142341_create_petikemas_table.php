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
        Schema::create('petikemas', function (Blueprint $table) {
            $table->id();
            $table->string('no_petikemas')->unique();
            $table->foreignId('transaksi_id');
            $table->dateTime('tanggal_keluar');
            $table->dateTime('tanggal_masuk');
            $table->string('jenis_ukuran');
            $table->string('pelayaran');
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petikemas');
    }
};
