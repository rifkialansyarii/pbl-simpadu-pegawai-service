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
        Schema::create('class_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pengampu_id');
            $table->foreignUuid('lecturer_id')->constrained(
                table: 'employees'
            );
            $table->uuid('class_id');
            $table->string('class_name');
            $table->char('course_code', 6);
            $table->string('course_name');
            $table->unsignedTinyInteger('session_number')->comment('Urutan sesi kelas');
            $table->string('topic')->nullable();
            $table->date('session_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['opened', 'closed'])->default('closed');
            $table->boolean('is_already_opened')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_sessions');
    }
};
