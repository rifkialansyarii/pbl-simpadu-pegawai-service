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
        Schema::create('grades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id');
            $table->char('nim', 10);
            $table->string('student_name');
            $table->uuid('class_id');
            $table->string('class_name');
            $table->char('course_code', 10);
            $table->string('course_name');
            $table->decimal('assignment_score', 5, 2);
            $table->decimal('uts_score', 5, 2);
            $table->decimal('uas_score', 5, 2);
            $table->decimal('final_score', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
