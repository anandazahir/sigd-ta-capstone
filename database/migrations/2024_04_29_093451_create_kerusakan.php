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
        Schema::create('kerusakan', function (Blueprint $table) {
            $table->id();
           $table->string('id_pengecekan');
           $table->integer('metode_perbaikan');
           $table->string('komponen_rusak');
            $table->string('status');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerusakan');
    }
};
