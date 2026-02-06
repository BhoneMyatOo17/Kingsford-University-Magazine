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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('student_id', 20)->unique(); // University student ID
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('restrict');
            $table->string('program'); // e.g., 'BSc Computer Science'
            $table->year('enrollment_year'); // e.g., 2024
            $table->enum('study_level', ['undergraduate', 'postgraduate', 'doctorate'])->default('undergraduate');
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('student_id');
            $table->index('faculty_id');
            $table->index('enrollment_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};