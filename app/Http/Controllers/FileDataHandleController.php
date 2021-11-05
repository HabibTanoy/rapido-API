<?php

namespace App\Http\Controllers;

use App\Models\ImportData;
use Illuminate\Http\Request;
use Carbon;
class FileDataHandleController extends Controller
{
    public function show(Request $request)
    {
        // $offset = $request->has('offset') ? $request->offset : 0;
        // $limit = $request->has('limit') ? $request->limit : 10;

        $import_table_data = ImportData::query();
        if ($request->has('status')) {
            $import_table_data->where('status', $request->status);
        }
        // if ($request->has('offset')) {
        //     $offset = $request->offset;
        // }

        // if ($request->has('limit')) {
        //     $limit = $request->limit;
        // }

        $import_table_data = $import_table_data->get();
    //    dd($import_table_data);
        return response()->json([
            'task' => $import_table_data,
            // 'offset' => (int) $offset,
            // 'limit' => (int) $limit,
            'message' => 'message',
            'status' => 200
        ]);
    }
    public function updateData($id) {
        $per_person_info = ImportData::where('id', $id)
            ->first();
        return view('updateDataInfo', compact('per_person_info'));
    }
    public function updated(Request $request, $id)
    {
        $person_update_info = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'comment' => $request->comment
        ];
        ImportData::where('id', $id)
            ->update($person_update_info);
        return redirect()->route('task-list');
    }
    public function delete($id) {
        ImportData::where('id', $id)
            ->delete();
        return redirect()->route('task-list');
    }
    public function dateFilter(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $current_date = Carbon\Carbon::now()->format('Y-m-d');
        if (is_null($start_date))
            $start_date = $current_date;
        if (is_null($end_date))
            $end_date = $current_date;
        $import_table_data = ImportData::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->get();
        return view('taskTableList', compact('import_table_data'));
    }

}
