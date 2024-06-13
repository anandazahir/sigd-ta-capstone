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
        Schema::create('pengecekans', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_kerusakan')->nullable();
            $table->dateTime('tanggal_pengecekan')->nullable();
            $table->string('survey_in')->nullable();
            $table->string('foto_profil')->nullable();
            $table->foreignId('penghubung_id')->nullable()->constrained('penghubungs')->onDelete('cascade');
            $table->foreignId('transaksi_id')->nullable()->constrained('transaksis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengecekans');
    }
};
