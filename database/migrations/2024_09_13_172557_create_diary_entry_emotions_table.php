<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diary_entry_emotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diary_entry_id')->constrained()->onDelete('cascade');
            $table->foreignId('emotion_id')->constrained()->onDelete('cascade');
            $table->integer('intensity'); // Ensure this column is defined as NOT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_entry_emotions');
    }
};