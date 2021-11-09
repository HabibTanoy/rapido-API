<?php

namespace App\Http\Controllers;

use App\Models\ImportData;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FileDataHandleController extends Controller
{
    public function show(Request $request)
    {
//        dd($delivery_man_id);
        $import_table_data = ImportData::query();
        if ($request->has('status')) {
            $import_table_data->where('status', $request->status);
        }

        $import_table_data = $import_table_data->get();
        return response()->json([
            'task' => $import_table_data,
            'message' => 'Created',
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
        return redirect()->route('product-list');
    }
    public function delete($id) {
        ImportData::where('id', $id)
            ->delete();
        return redirect()->route('product-list');
    }
    public function dateFilter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $current_date = Carbon::now()->format('Y-m-d');
        if (is_null($start_date))
            $start_date = $current_date;
        if (is_null($end_date))
            $end_date = $current_date;
        $list_of_product = ImportData::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->get();
        return view('taskTableList', compact('list_of_product'));

    }
    public function dataCount()
    {
        $today_data_count = ImportData::whereDate('created_at', Carbon::today())
            ->where('status', '=', 'delivered')
            ->get();
//        dd(count($today_data_count));
        $yesterday_data_count = ImportData::whereDate('created_at', Carbon::yesterday())
            ->where('status', '=', 'delivered')
            ->get();
        return view('dashboard', compact('today_data_count', 'yesterday_data_count'));
    }

}
