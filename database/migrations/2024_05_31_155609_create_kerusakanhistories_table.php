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
            $table->dateTime('tanggal_perubahan')->nullable();
            $table->foreignId('kerusakan_id')->constrained('kerusakans')->onDelete('cascade')->nullable();
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