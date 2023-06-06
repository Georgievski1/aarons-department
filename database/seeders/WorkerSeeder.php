<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WorkerSeeder extends Seeder
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
              return [
                  "name" => $row[1],
                  "company" => $row[2],
                  "created_at" => Carbon::now(),
                  "updated_at" => Carbon::now()
              ];
            })->toArray();
            
            DB::table('workers')->insert($records);
          });
        
    }
}
