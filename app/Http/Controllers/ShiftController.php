<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Worker;

class ShiftController extends Controller
{
    public function index() {
        return Shift::with('worker')->paginate(200);
    }

    public function create(Request $request){
        $request->validate([
            'shift_date' => 'required',
            'user_id' => 'required',
            'hours' => 'required',
            'hour_rate' => 'required',
            'taxable' => 'required',
            'status' => 'required',
            'shift_type' => 'required',
        ]);

        $userName = $request['user_id'];
        $user = Worker::where('name', 'like', '%'. $userName .'%')->where('company', 'like', '%'. $request['user_company'] .'%')->first();

        if($user) {
            $userId = $user->id;
        } else {
            $newUser = Worker::create(['name' => $userName, 'company' => $request['user_company']]);
            $userId = $newUser->id;
        }

        $hours = (int)$request['hours'];
        $hour_rate = (int)$request['hour_rate'];
        $total = $hours * $hour_rate;

        return Shift::create([
            'shift_date' => $request['shift_date'],
            'user_id' => $userId,
            'hours' => $hours,
            'hour_rate' => $hour_rate,
            'taxable' => $request['taxable'],
            'status' => $request['status'],
            'shift_type' => $request['shift_type'],
            'paid' => $request['paid'],
            'total' => $total
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'shift_date' => 'required',
            'user_id' => 'required',
            'hours' => 'required',
            'hour_rate' => 'required',
            'taxable' => 'required',
            'status' => 'required',
            'shift_type' => 'required',
        ]);

        $shift = Shift::find($id);

        $userName = $request['user_id'];
        $user = Worker::where('name', 'like', '%'. $userName .'%')->where('company', 'like', '%'. $request['user_company'] .'%')->first();

        if($user) {
            $userId = $user->id;
        } else {
            $newUser = Worker::create(['name' => $userName, 'company' => $request['user_company']]);
            $userId = $newUser->id;
        }

        $hours = (int)$request['hours'];
        $hour_rate = (int)$request['hour_rate'];
        $total = $hours * $hour_rate;

        $shift->update([
            'shift_date' => $request['shift_date'],
            'user_id' => $userId,
            'hours' => $hours,
            'hour_rate' => $hour_rate,
            'taxable' => $request['taxable'],
            'status' => $request['status'],
            'shift_type' => $request['shift_type'],
            'paid' => $request['paid'],
            'total' => $total
        ]);
        return $shift;
    }

    public function delete($id){
        $shift = Shift::find($id);
        $shift->delete();
        return $shift;
    }

    public function queryShifts($q) {
        $qint = (int)$q;
        return Shift::where('total', '>=', $qint)->with('worker')->paginate(200);
    }
}
