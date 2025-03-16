<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ArchiveReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archive:reports';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to archive reports';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reports = ReportIncident::where('status', 'Solved')->get(); // Example condition

    foreach ($reports as $report) {
        $archivedReport = $report->replicate(); // Copy the report
        $archivedReport->is_archived = true;
        $archivedReport->save();

        // Optional: Delete or mark the original report
        $report->delete();
    }

    $this->info('Reports have been archived successfully.');
    }
}
