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
        Schema::table('archives', function (Blueprint $table) {
            DB::statement('ALTER TABLE archives CHANGE section grade_level VARCHAR(50) NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            DB::statement('ALTER TABLE archives CHANGE grade_level section VARCHAR(50) NULL');
        });
    }
};
