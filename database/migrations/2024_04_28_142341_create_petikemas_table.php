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
            $table->dateTime('tanggal_keluar')->nullable();
            $table->dateTime('tanggal_masuk');
            $table->string('jenis_ukuran');
            $table->string('pelayaran');
            $table->bigInteger('harga');
            $table->string('status_ketersediaan');
            $table->string('status_kondisi');
            $table->string('lokasi');
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
