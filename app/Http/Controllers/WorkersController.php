<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use App\Models\Worker;

class WorkersController extends Controller
{
    public function index() {
        return Worker::paginate(200);
    }

    public function singleWorker($id) {
        $worker = Worker::find($id);
        $shifts = Shift::where('user_id', $id);
        $completedShifts = Shift::where('user_id', $id)->where('status', 'like', '%Complete%')->take(5)->get();
        $avgPerHour = round($shifts->avg('hour_rate'), 2);
        $avgTotal = round($shifts->avg('total'), 2);

        return ['worker' => $worker, 'avgPerHour' => $avgPerHour, 'avgTotal' => $avgTotal, 'completedShifts' => $completedShifts];
    }
}
