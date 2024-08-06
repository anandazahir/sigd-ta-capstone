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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_cuti');
            $table->dateTime('tanggal_dibuat');
            $table->string('url_file')->nullable();
            $table->string('file_name')->nullable();
            $table->dateTime('mulai_cuti')->nullable();
            $table->dateTime('selesai_cuti')->nullable();
            $table->string('alasan_cuti')->nullable();
            $table->string('sign_acc')->nullable();
            $table->string('status');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
