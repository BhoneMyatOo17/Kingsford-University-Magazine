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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., '2024/2025'
            $table->year('year'); // e.g., 2024
            $table->date('closure_date'); // Deadline for new submissions
            $table->date('final_closure_date'); // Deadline for updates
            $table->boolean('is_active')->default(false); // Only one can be active
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('year');
            $table->index('is_active');
            $table->index('closure_date');
            $table->index('final_closure_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};