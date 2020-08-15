<?php

namespace App\Http\Controllers;

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
}
