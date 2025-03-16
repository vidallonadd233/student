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
        Schema::table('studentarchive', function (Blueprint $table) {
            $table->softDeletes(); //
            $table->boolean('archived')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('studentarchive', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('archived');

        });
    }
};
