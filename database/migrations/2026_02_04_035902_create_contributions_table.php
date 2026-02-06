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
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('academic_year_id')->constrained('academic_years')->onDelete('restrict');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('document_path'); // Path to Word document
            $table->string('document_name'); // Original filename
            $table->boolean('terms_accepted')->default(false);
            $table->timestamp('terms_accepted_at')->nullable();
            $table->boolean('is_selected')->default(false); // Selected for publication
            $table->timestamp('selected_at')->nullable();
            $table->foreignId('selected_by')->nullable()->constrained('users')->onDelete('set null'); // Marketing Coordinator who selected
            $table->enum('status', ['draft', 'submitted', 'under_review', 'selected', 'rejected'])->default('submitted');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('student_id');
            $table->index('academic_year_id');
            $table->index('is_selected');
            $table->index('status');
            $table->index(['student_id', 'academic_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};