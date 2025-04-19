<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemarkToReportIncidentTable extends Migration
{
    public function up()
    {
        Schema::table('report_incident', function (Blueprint $table) {
            $table->text('remark')->nullable()->after('status'); // Adjust position if needed
        });
    }

    public function down()
    {
        Schema::table('report_incident', function (Blueprint $table) {
            $table->dropColumn('remark');
        });
    }
}
