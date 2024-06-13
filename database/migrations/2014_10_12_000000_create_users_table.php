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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nip')->unique();
            $table->string('nik')->unique();
            $table->string('nama')->unique();
            $table->string('no_hp')->unique();
            $table->string('jabatan');
            $table->string('alamat')->unique();
            $table->string('agama');
            $table->string('foto')->nullable();
            $table->char('JK');
            $table->string('pendidikan_terakhir');
            $table->date('tanggal_lahir');
            $table->string('status_menikah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
