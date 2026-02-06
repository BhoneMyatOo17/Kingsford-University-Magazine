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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('staff_id', 20)->unique(); // Employee ID
            $table->foreignId('faculty_id')->nullable()->constrained('faculties')->onDelete('restrict'); // Only for Marketing Coordinators
            $table->string('department')->nullable(); // e.g., 'Marketing', 'Administration'
            $table->string('position')->nullable(); // e.g., 'Marketing Coordinator', 'Marketing Manager'
            $table->date('hire_date')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('office_location')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('staff_id');
            $table->index('faculty_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};