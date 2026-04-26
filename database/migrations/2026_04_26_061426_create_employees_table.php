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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->char('nip', 18)->unique();
            $table->char('nik', 16)->unique();
            $table->string('employee_name');
            $table->text('address')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('phone_number', 20)->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('village_id')->constrained(
                table: 'indonesia_villages'
            );
            $table->foreignId('district_id')->nullable()->constrained(
                table: 'indonesia_districts'
            );
            $table->foreignId('city_id')->nullable()->constrained(
                table: 'indonesia_cities'
            );
            $table->foreignId('province_id')->nullable()->constrained(
                table: 'indonesia_provinces'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
