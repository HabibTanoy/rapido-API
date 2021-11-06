<?php

namespace App\Http\Controllers;

use App\Models\ImportData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusUpdateAPIController extends Controller
{

    public function assignedStatus(Request $request)
    {
    //     $validator = Validator::make($request->all(),
    //     [
    //         'id' => 'required',
    //         'assign_to' => 'required'
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'validation error'
    //         ]);
    //     }
        $task_id = $request->task_id;
        $task = ImportData::find($task_id);
//        dd($task);
        if ($task->status != "created") {
            return response()->json([
                'message' => 'error'
            ]);
        }
        $assigned = 'assigned';
        $task->update([
            'status' => $assigned,
           'assign_to' => $request->assign_to
        ]);
        return response()->json([
           "data" => $task,
           'message' => 'Assigned',
           'status' => 200
        ]);
    }
}
