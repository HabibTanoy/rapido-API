<?php

namespace App\Http\Controllers;

use App\Models\ImportData;
use App\Tools\FetchTraceUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FileDataHandleController extends Controller
{
    public function updateOrderInformation($id) {
        $order_update = ImportData::where('id', $id)
            ->first();
        $agents = (new FetchTraceUsers())
            ->setApiKey(env('BKOI_TRACE_API_KEY'))
            ->get();
        return view('updateOrder', compact('order_update', 'agents'));
    }
//for update order information
    public function updatedOrder(Request $request, $id)
    {
        $update_order_info = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'comment' => $request->comment,
            'status' => $request->update_status,
            'assign_to' => $request->agent_id,
            'assigned_name' => $request->agent_name
        ];
        ImportData::where('id', $id)
            ->update($update_order_info);
        return redirect()->route('order-list');
    }
// for delete order
    public function deleteOrder($id) {
        ImportData::where('id', $id)
            ->delete();
        return redirect()->route('order-list');
    }
// filter order list by date
    public function orderDateFilter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $current_date = Carbon::now()->format('Y-m-d');
        if (is_null($start_date))
            $start_date = $current_date;
        if (is_null($end_date))
            $end_date = $current_date;
        $orders = ImportData::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->get();
        return view('orderList', compact('orders'));
    }
// data count for how many deliverd in today and yesterday
    public function dataCount()
    {
        $today_data_count = ImportData::whereDate('created_at', Carbon::today())
            ->where('status', '=', 'delivered')
            ->get();
        $yesterday_data_count = ImportData::whereDate('created_at', Carbon::yesterday())
            ->where('status', '=', 'delivered')
            ->get();
        return view('dashboard', compact('today_data_count', 'yesterday_data_count'));
    }

}
