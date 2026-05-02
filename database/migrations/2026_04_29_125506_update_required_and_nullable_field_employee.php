<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    
    private function updateForeignId(string $tableName, int $lenColumn)
    {
       Schema::table("employees", function (Blueprint $table) use ($tableName, $lenColumn){
            $table->dropForeign(["{$tableName}_code"]);

            $table->char("{$tableName}_code", $lenColumn)->nullable()->change();

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
            10 => 'village',
            6 => 'district', 
            4 => 'city', 
            2 => 'province'
        ];

       foreach ($tableList as $key => $value) {
        $this->updateForeignId($value, $key);
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
