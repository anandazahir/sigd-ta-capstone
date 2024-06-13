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
        Schema::create('perbaikanhistories', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_perbaikan')->nullable();
            $table->dateTime('tanggal_perbaikan')->nullable();
            $table->string('repair')->nullable();
            $table->string('estimator')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('status_kondisi')->nullable();
            $table->foreignId('petikemas_id')->constrained('petikemas')->onDelete('cascade')->nullable();
            $table->bigInteger('id_perbaikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikanhistories');
    }
};
