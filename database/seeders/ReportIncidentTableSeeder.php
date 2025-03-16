<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ReportIncidentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reports')->insert([
            [
                'student_number' => '202312345',
                'age' => 17,
                'report_date' => Carbon::now()->toDateString(),
                'category' => 'Bullying',
                'location' => 'Hallway',
                'assigned' => 'Counselor A',
                'evidence' => 'videos/evidence1.mp4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'student_number' => '202398765',
                'age' => 16,
                'report_date' => Carbon::now()->subDays(3)->toDateString(),
                'category' => 'Cyberbullying',
                'location' => 'Library',
                'assigned' => 'Counselor B',
                'evidence' => 'videos/evidence2.mp4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'student_number' => '202376543',
                'age' => 15,
                'report_date' => Carbon::now()->subWeek()->toDateString(),
                'category' => 'Verbal Abuse',
                'location' => 'Classroom',
                'assigned' => null,
                'evidence' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
    }

