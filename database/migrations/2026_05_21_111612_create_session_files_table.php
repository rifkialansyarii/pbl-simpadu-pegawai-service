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
        Schema::create('session_files', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('class_session_id')->constrained('class_sessions')->cascadeOnDelete();
            $table->foreignUuid('file_upload_id')->constrained('file_uploads')->cascadeOnDelete();
            $table->enum('type', ['material', 'assignment']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_materials');
    }
};
