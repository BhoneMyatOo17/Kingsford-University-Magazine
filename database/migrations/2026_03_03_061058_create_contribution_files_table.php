<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contribution_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contribution_id')->constrained('contributions')->onDelete('cascade');
            $table->enum('file_type', ['document', 'image']); // document = word/pdf, image = jpg/png etc
            $table->string('disk')->default('s3_documents');   // s3_documents or s3_images
            $table->string('file_path');
            $table->string('original_name');
            $table->string('mime_type');
            $table->unsignedBigInteger('file_size'); // bytes
            $table->timestamps();

            $table->index('contribution_id');
            $table->index('file_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contribution_files');
    }
};
