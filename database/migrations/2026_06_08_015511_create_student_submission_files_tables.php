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
        Schema::create('student_submission_files_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('submission_id')->constrained('student_submissions')->cascadeOnDelete();
            $table->foreignUuid('file_upload_id')->constrained('file_uploads')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_submission_files_tables');
    }
};
