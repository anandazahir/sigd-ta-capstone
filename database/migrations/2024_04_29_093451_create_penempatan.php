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
        Schema::create('Penempatan', function (Blueprint $table) {
            $table->id();
           $table->string('lokasi');
           $table->integer('ketersediaan_peti_kemas');
           $table->dateTime('tanggal_penempatan');
            $table->string('operator_alat_berat');
            $table->string('Tally');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penempatan');
    }
};
