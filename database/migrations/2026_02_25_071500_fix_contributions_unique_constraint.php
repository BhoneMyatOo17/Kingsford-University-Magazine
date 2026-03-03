<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contributions', function (Blueprint $table) {
            $table->unique(['student_id', 'post_id', 'deleted_at'], 'contributions_student_post_active_unique');
        });
    }

    public function down(): void
    {
        Schema::table('contributions', function (Blueprint $table) {
            $table->dropUnique('contributions_student_post_active_unique');
            $table->unique(['student_id', 'post_id']);
        });
    }
};
