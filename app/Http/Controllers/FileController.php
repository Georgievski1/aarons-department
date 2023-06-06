<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class FileController extends Controller
{
    public function upload(Request $request){
        try{
            if($request->hasFile('csv_file')) {
                $upload_path = public_path('csv');
                $file = $request->file('csv_file');
                $file->move($upload_path, $file->getClientOriginalName());

                Artisan::call('db:seed', ['--class' => 'WorkerSeeder']);
                Artisan::call('db:seed', ['--class' => 'ShiftSeeder']);

                return response()->json([
                    'message' => 'File uploaded successfully.'
                ], 200);
            }
        } catch(\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
