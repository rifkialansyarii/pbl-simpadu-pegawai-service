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
            $table->uuid('id')->primary();
            $table->char('nip', 18)->unique();
            $table->char('nik', 16)->unique();
            $table->string('employee_name');
            $table->text('address')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('phone_number', 20)->nullable();

            $table->char('village_code', 10)->nullable();
            $table->foreign('village_code')->references('code')->on('indonesia_villages');

            $table->char('district_code', 6)->nullable();
            $table->foreign('district_code')->references('code')->on('indonesia_districts');

            $table->char('city_code', 4)->nullable();
            $table->foreign('city_code')->references('code')->on('indonesia_cities');

            $table->char('province_code', 2)->nullable();
            $table->foreign('province_code')->references('code')->on('indonesia_provinces');

            $table->char('citizen_code', 2)->nullable();
            $table->foreign('citizen_code')->references('code')->on('countries');

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
