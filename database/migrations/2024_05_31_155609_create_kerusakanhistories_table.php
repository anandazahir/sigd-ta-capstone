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
        Schema::create('kerusakanhistories', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi_kerusakan')->nullable();
            $table->string('komponen')->nullable();
            $table->string('status')->nullable();
            $table->string('metode')->nullable();
            $table->string('harga')->nullable();
            $table->string('foto_pengecekan')->nullable();
            $table->string('foto_perbaikan')->nullable();
            $table->bigInteger('id_kerusakan')->nullable();
            $table->bigInteger('id_pengecekanhistory')->nullable();
            $table->bigInteger('id_perbaikanhistory')->nullable();
            $table->dateTime('tanggal_perubahan')->nullable();
            $table->foreignId('petikemas_id')->constrained('petikemas')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerusakanhistories');
    }
};
