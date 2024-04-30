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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
           $table->string('no_transaksi')->unique();
           $table->string('jenis_kegiatan');
           $table->integer('no_do')->unique();
           $table->dateTime('tanggal_DO_rilis');
            $table->dateTime('tanggal_DO_exp');
            $table->string('perusahaan');
            $table->integer('jumlah_petikemas');
            $table->string('kapal');
            $table->string('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
