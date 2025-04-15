<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all department IDs
        $departmentIds = Department::pluck('id')->toArray();

        // Get the start and end of the current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $schedules = []; // Use an array to hold the data before inserting

        for ($i = 0; $i < 50; $i++) {
            // Generate random started_at and ended_at within the current month
            $startedAt = Carbon::createFromTimestamp(rand($startOfMonth->timestamp, $endOfMonth->timestamp));
            $endedAt = Carbon::createFromTimestamp(rand($startedAt->timestamp, $endOfMonth->timestamp));

            $schedule = [
                'department_id' => $departmentIds[array_rand($departmentIds)], // Use a random department ID
                'title' => "Schedule " . ($i + 1),
                'description' => "Description for Schedule " . ($i + 1),
                'started_at' => $startedAt,
                'ended_at' => $endedAt,
                'completed_at' => rand(0, 1) ? $endedAt : null, // Randomly set completed_at
                'created_at' => now(), // Set created_at
                'updated_at' => now(), // and updated_at
            ];
            $schedules[] = $schedule;
        }
        DB::table('schedules')->insert($schedules); // Use the DB facade to insert the array
    }
}
