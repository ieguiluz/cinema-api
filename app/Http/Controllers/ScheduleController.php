<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request) {
        $data = Schedule::orderBy('id');

        if ($request->has('active')) {
            $schedules = $data->where('is_active', true)->get();
        } else {
            $schedules = $data->paginate(10);
        }

        return response()->json([
            'schedules' => $schedules,
        ], 200);
    }

    public function show($id) {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json([
                'msg' => 'Id provided does not exist.',
            ], 422);
        }

        return response()->json([
            'schedule' => $schedule,
        ], 200);
    }

    public function store(ScheduleRequest $request) {
        $new_schedule = new Schedule();
        $new_schedule->time = $request->input('time');
        $new_schedule->is_active = $request->input('is_active');
        $new_schedule->save();

        return response()->json([
            'msg' => 'Schedule saved successfully',
            'new_schedule' => $new_schedule,
        ], 200);
    }

    public function update(Request $request, Schedule $schedule) {
        $schedule->time = $request->input('time');
        $schedule->is_active = $request->input('is_active');
        $schedule->save();

        return response()->json([
            'msg' => 'Schedule updated successfully',
            'schedule' => $schedule,
        ], 200);
    }

    public function delete($id) {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json([
                'msg' => 'Id provided does not exist.',
            ], 422);
        }

        $schedule->delete();

        return response()->json([
            'msg' => 'Schedule deleted successfully',
        ], 200);
    }
}
