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
        Schema::create('drone_media', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable(); // Optional for cloud storage URL
            $table->string('filename');
            // $table->string('url')->unique(); // Optional for cloud storage URL
            // $table->string('filename')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Add foreign key constraint to associate with users table
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drone_media');
    }
};
