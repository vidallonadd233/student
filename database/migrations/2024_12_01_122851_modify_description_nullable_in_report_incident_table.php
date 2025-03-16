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
        Schema::table('report_incident', function (Blueprint $table) {
            $table->text('description')->default('No description provided')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_incident', function (Blueprint $table) {
            $table->text('description')->default(null)->change();
        });
    }
};
