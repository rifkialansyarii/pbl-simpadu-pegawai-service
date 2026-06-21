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
        Schema::create('student_submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUUid('assignment_id')->constrained('student_assignments')->restrictOnDelete();
            $table->uuid('student_id');
            $table->char('nim', 10);
            $table->string('student_name');
            $table->datetime('submitted_at')->nullable();
            $table->decimal('score', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_submissions');
    }
};
