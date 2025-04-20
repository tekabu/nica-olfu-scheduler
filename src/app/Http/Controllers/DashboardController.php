<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Schedule;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $schedules = Schedule::with(['department'])
        ->get();

        # dd($schedules->toArray());

        $events = [];

        foreach ($schedules as $schedule) {
            $event = [];
            $event['title'] = $schedule->title;
            $event['start'] = date('Y-m-d', strtotime($schedule->started_at));
            $event['end'] = date('Y-m-d', strtotime($schedule->ended_at));
            
            if ($schedule->completed_at === null && strtotime(date('Y-m-d')) > strtotime($event['end'])) {
                $event['status'] = 'Due';
                $event['backgroundColor'] = '#FF0000';  // red hex
            } else if ($schedule->completed_at === null && strtotime(date('Y-m-d')) <= strtotime($event['end'])) {
                $event['status'] = 'On-Going';
                $event['backgroundColor'] = '#FFFF00';  // yellow hex
            } else if ($schedule->completed_at !== null) {
                $event['status'] = 'Completed';
                $event['backgroundColor'] = '#00FF00';  // green hex
            }
        
            array_push($events, $event);
        }

        $total = count($schedules);
        $onGoing = count(array_filter($events, fn($event) => $event['status'] === 'On-Going'));
        $completed = count(array_filter($events, fn($event) => $event['status'] === 'Completed'));
        $due = count(array_filter($events, fn($event) => $event['status'] === 'Due'));

        $schedules = $schedules->map(function ($item) {
            return [
                'department_name' => $item->department_name,
                'title' => $item->title,
                'description' => $item->description,
                'started_date' => $item->started_date,
                'ended_date' => $item->ended_date,
                'completed_date' => $item->completed_date,
            ];
        });

        return view('dashboard', [
            'user'=> $user,
            'events' => $events,
            'total' => $total,
            'onGoing' => $onGoing,
            'completed' => $completed,
            'due' => $due,
            'schedules' => $schedules->toJson(),
        ]);
    }
}
