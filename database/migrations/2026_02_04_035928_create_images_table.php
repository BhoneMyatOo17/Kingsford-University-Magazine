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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contribution_id')->constrained('contributions')->onDelete('cascade');
            $table->string('path'); // Storage path
            $table->string('filename'); // Original filename
            $table->string('mime_type'); // e.g., 'image/jpeg'
            $table->unsignedBigInteger('size'); // File size in bytes
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->text('caption')->nullable();
            $table->unsignedInteger('order')->default(0); // Display order
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('contribution_id');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};