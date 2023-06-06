<?php

namespace Database\Seeders;

use App\Models\Worker;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LazyCollection::make(function () {
            $handle = fopen(public_path("csv/shifts.csv"), 'r');
            
            while (($line = fgetcsv($handle, 4096)) !== false) {
              $dataString = implode(", ", $line);
              $row = explode(',', $dataString);
              yield $row;
            }
      
            fclose($handle);
          })
          ->skip(1)
          ->chunk(1000)
          ->each(function (LazyCollection $chunk) {
            $records = $chunk->map(function ($row) {
            $worker = Worker::where('name', $row[1])->where('company', $row[2])->first();
            $hours = (int)$row[3];
            $hour_rate = preg_replace("/[^0-9\.]/", '', $row[4]);
            $hour_rate = (int)$hour_rate;
            $total = $hours * $hour_rate;
              return [
                  "shift_date" => $row[0],
                  "user_id" => $worker->id,
                  "hours" => $hours,
                  "hour_rate" => $hour_rate,
                  "taxable" => $row[5],
                  "status" => $row[6],
                  "shift_type" => $row[7],
                  "paid" => $row[8],
                  "total" => $total,
                  "created_at" => Carbon::now(),
                  "updated_at" => Carbon::now()
              ];
            })->toArray();
            
            DB::table('shifts')->insert($records);
          });
    }
}
