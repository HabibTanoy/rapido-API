<?php

namespace App\Http\Controllers;

use App\Models\ImportData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusUpdateAPIController extends Controller
{

    public function assignedStatus(Request $request)
    {
         $validator = Validator::make($request->all(),
         [
             'task_id' => 'required',
             'assign_to' => 'required'
         ]);
         if ($validator->fails()) {
             return response()->json([
                 'message' => 'validation error'
             ]);
         }
        $task_id = $request->task_id;
        $task = ImportData::find($task_id);
//        dd($task);
        if ($task->status != "created") {
            return response()->json([
                'message' => 'Assigned Already'
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
    public function deliveredStatus(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'task_id' => 'required',
                'received_amount' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Parameter not found'
            ]);
        }
        $task_id = $request->task_id;
        $task = ImportData::find($task_id);
        if ($task->status != "assigned") {
           return response()->json([
                'message' => 'Already Delivered'
           ]);
        }
        $task->update([
            'received_amount' => $request->received_amount,
            'status' => 'delivered'
        ]);
        return response()->json([
           'data' => $task,
           'message' => 'Delivered',
           'status' => 200
        ]);
    }
}
