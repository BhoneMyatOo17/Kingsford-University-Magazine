<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('restrict');
            $table->foreignId('academic_year_id')->constrained('academic_years')->onDelete('restrict');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->date('closure_date');         // Student submission deadline (before academic_year closure_date)
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('faculty_id');
            $table->index('academic_year_id');
            $table->index('closure_date');
            $table->index('is_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
