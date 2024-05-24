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
        Schema::create('kerusakans', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi_kerusakan')->nullable();
            $table->string('komponen')->nullable();
            $table->string('status')->nullable();
            $table->string('metode')->nullable();
            $table->string('harga')->nullable();
            $table->string('foto_pengecekan')->nullable();
            $table->string('foto_perbaikan')->nullable();
            $table->string('foto_pengecekan_name')->nullable();
            $table->string('foto_perbaikan_name')->nullable();
            $table->foreignId('pengecekan_id')->constrained('pengecekans')->onDelete('cascade')->nullable();
            $table->foreignId('perbaikan_id')->constrained('perbaikans')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerusakans');
    }
};
