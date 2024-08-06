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
        Schema::create('absensihistories', function (Blueprint $table) {
            $table->id();
            $table->dateTime('waktu_perubahan');
            $table->dateTime('waktu_absensi');
            $table->string('user');
           
            $table->foreignId('absensi_id')->constrained('absensis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensihistories');
    }
};
