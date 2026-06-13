<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grade_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('lecturer_id')->constrained('employees')->cascadeOnDelete();
            $table->char('course_code', 10);
            $table->string('course_name');
            $table->decimal('assignment', 5, 2);
            $table->decimal('uts', 5, 2);
            $table->decimal('uas', 5, 2);
            $table->timestamps();

            $table->unique(['course_code', 'course_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_settings');
    }
};
