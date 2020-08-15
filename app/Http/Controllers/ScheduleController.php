<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index() {
        $schedules = Schedule::orderBy('id')->paginate(10);

        return response()->json([
            'schedules' => $schedules,
        ], 200);
    }

    public function show(Schedule $schedule) {
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
            'msg' => 'Schedule saved sucessfully',
            'new_schedule' => $new_schedule,
        ], 200);
    }

    public function update(Request $request, Schedule $schedule) {
        dump($request->input());
        dd($schedule);
    }

    public function delete(Schedule $schedule) {
        $schedule->delete();

        return response()->json([
            'msg' => 'Schedule deleted sucessfully',
        ], 200);
    }
}
