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
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_perbaikan')->nullable();
            $table->string('repair')->nullable();
            $table->string('estimator')->nullable();
            $table->string('jumlah_perbaikan')->nullable();
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
        Schema::dropIfExists('perbaikans');
    }
};
