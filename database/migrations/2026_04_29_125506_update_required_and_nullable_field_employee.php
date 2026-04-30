<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    private function updateForeignId(string $tableName)
    {
        Schema::table("employees", function (Blueprint $table) use ($tableName) {
            $table->dropForeign(["{$tableName}_code"]);

            $table->char("{$tableName}_code")->nullable()->change();

            $table->foreign("{$tableName}_code")
                ->references("code")
                ->on($tableName == 'city' ? 'indonesia_cities' : "indonesia_" . $tableName . "s");

        });
    }

    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->enum('gender', ['male', 'female'])->nullable()->change();

        });

        $tableList = [
            'village',
            'district',
            'city',
            'province'
        ];

        foreach ($tableList as $t) {
            $this->updateForeignId($t);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};
