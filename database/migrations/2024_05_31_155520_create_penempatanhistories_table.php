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
        Schema::create('penempatanhistories', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_penempatan')->nullable();
            $table->string('operator_alat_berat')->nullable();
            $table->string('tally')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('status_ketersediaan')->nullable();
            $table->foreignId('petikemas_id')->constrained('petikemas')->onDelete('cascade')->nullable();
            $table->bigInteger('id_penempatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penempatanhistories');
    }
};
