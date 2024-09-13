<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('personality_types', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // เพิ่มคอลัมน์ type
            $table->string('name');
            $table->text('description'); // เพิ่มคอลัมน์ description
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personality_types');
    }
};