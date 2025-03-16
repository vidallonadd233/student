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
        Schema::table('calendar', function (Blueprint $table) {
            $table->boolean('archived')->default(false);  // Default to false (not archived)

            // Add 'deleted_at' column for soft delete functionality
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calendar', function (Blueprint $table) {
             // Drop 'archived' column
             $table->dropColumn('archived');

             // Drop the 'deleted_at' column for soft deletes
             $table->dropSoftDeletes();
        });
    }
};
