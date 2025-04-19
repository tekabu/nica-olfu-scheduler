<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Schedule;

class ScheduleController extends Controller
{
    private $parent_route = 'schedules';

    private $templates_dir = 'schedules';

    private $table_model = null;

    private $table_row = null;

    function __construct()
    {
        $this->table_model = Schedule::class;

        $this->table_row = null;
    }
    public function index()
    {
        $user = Auth::user();

        $table = $this->table_model::get();

        $table->each(function ($item, $key) {
            $this->addTableRowAction($item);
        });

        $table = $table->map(function ($item) {
            return [
                'action' => $item->action,
                'action_edit' => $item->action_edit,
                'action_update' => $item->action_update,
                'action_delete' => $item->action_delete,
                'title' => $item->title,
                'description' => $item->description,
                'started_date' => $item->started_date,
                'ended_date' => $item->ended_date,
                'completed_date' => $item->completed_date,
            ];
        });

        return view($this->templates_dir . '.table', [
            'user' => $user,
            'table_data' => $table->toJson(),
            'parent_route' => $this->parent_route,
        ]);
    }
    private function addTableRowAction(&$table_row = null)
    {
        if (is_null($table_row))
            $table_row =& $this->table_row;

        $items = [];

        $items[] = el('a.dropdown-item.edit-row[href=#]', [
            el('i.ph-pencil-simple-line.me-2'),
            'Edit'
        ]);

        $items[] = el('a.dropdown-item.delete-row[href=#]', [
            el('i.ph-trash.me-2'),
            'Delete'
        ]);

        $table_row->action = el('.d-inline-flex > .dropdown', [
            el('a.text-body.actions[href=#][data-bs-toggle=dropdown]', [
                el('i.ph-list')
            ]),
            el('.dropdown-menu dropdown-menu-end', $items)
        ]);

        $table_row->action_edit = route($this->parent_route . '.edit', $table_row->id);

        $table_row->action_update = route($this->parent_route . '.update', $table_row->id);

        $table_row->action_delete = route($this->parent_route . '.delete', $table_row->id);
    }
    public function createSchedule()
    {
        $user = Auth::user();

        return response()->json([
            'status' => true,
            'html' => view($this->templates_dir . '.entry', [
                'parent_route' => $this->parent_route,
            ])->render()
        ]);
    }
    public function deleteSchedule($id)
    {
        $schedule = $this->table_model::find($id);

        if ($schedule) {
            $schedule->delete();
            return response()->json([
                'status' => true,
                'message' => 'Schedule deleted successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Schedule not found.'
            ]);
        }
    }
    public function storeSchedule(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'started_date' => 'required|date',
            'ended_date' => 'required|date|after_or_equal:started_date',
            'completed_date' => 'nullable|date|after_or_equal:ended_date',
        ]);

        $schedule = new Schedule();
        $schedule->department_id = 1;
        $schedule->title = $request->input('title');
        $schedule->description = $request->input('description');
        $schedule->started_at = $request->input('started_date');
        $schedule->ended_at = $request->input('ended_date');
        $schedule->completed_at = $request->input('completed_date');
        $schedule->save();

        $this->addTableRowAction($schedule);

        $schedule = [
            'action' => $schedule->action,
            'action_edit' => $schedule->action_edit,
            'action_update' => $schedule->action_update,
            'action_delete' => $schedule->action_delete,
            'title' => $schedule->title,
            'description' => $schedule->description,
            'started_date' => $schedule->started_date,
            'ended_date' => $schedule->ended_date,
            'completed_date' => $schedule->completed_date,
        ];

        return response()->json([
            'status' => true,
            'data' => $schedule
        ]);
    }
    public function editSchedule($id)
    {
        $schedule = $this->table_model::find($id);

        $schedule = $schedule->toArray();
        $schedule['started_date'] = date('Y-m-d', strtotime($schedule['started_at']));
        $schedule['ended_date'] = date('Y-m-d', strtotime($schedule['ended_at']));
        $schedule['completed_date'] = $schedule['completed_date'] ?
            date('Y-m-d', strtotime($schedule['completed_at']))
            : null;

        $schedule = (object) $schedule;

        if ($schedule) {
            return response()->json([
                'status' => true,
                'html' => view($this->templates_dir . '.entry', [
                    'parent_route' => $this->parent_route,
                    'row' => $schedule
                ])->render()
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Schedule not found.'
            ]);
        }
    }
    public function updateSchedule($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'started_date' => 'required|date',
            'ended_date' => 'required|date|after_or_equal:started_date',
            'completed_date' => 'nullable|date|after_or_equal:ended_date',
        ]);

        $schedule = $this->table_model::find($id);

        if ($schedule) {
            $schedule->title = $request->input('title');
            $schedule->description = $request->input('description');
            $schedule->started_at = $request->input('started_date');
            $schedule->ended_at = $request->input('ended_date');
            $schedule->completed_at = $request->input('completed_date');
            $schedule->save();

            $this->addTableRowAction($schedule);

            $schedule = [
                'action' => $schedule->action,
                'action_edit' => $schedule->action_edit,
                'action_update' => $schedule->action_update,
                'action_delete' => $schedule->action_delete,
                'title' => $schedule->title,
                'description' => $schedule->description,
                'started_date' => $schedule->started_date,
                'ended_date' => $schedule->ended_date,
                'completed_date' => $schedule->completed_date,
            ];

            return response()->json([
                'status' => true,
                'data' => $schedule
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Schedule not found.'
            ]);
        }
    }
}
