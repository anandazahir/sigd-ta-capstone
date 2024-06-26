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
        Schema::create('pengecekanhistories', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_kerusakan')->nullable();
            $table->dateTime('tanggal_pengecekan')->nullable();
            $table->string('survey_in')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('status_kondisi')->nullable();
            $table->foreignId('petikemas_id')->constrained('petikemas')->onDelete('cascade')->nullable();
            $table->bigInteger('id_pengecekan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengecekanhistories');
    }
};
