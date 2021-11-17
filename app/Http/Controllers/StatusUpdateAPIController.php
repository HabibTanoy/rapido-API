<?php

namespace App\Http\Controllers;

use App\Models\ImportData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusUpdateAPIController extends Controller
{
    // order list api
    public function orderList()
    {
        $all_orders_list = ImportData::get();
        return response()->json([
           'data' => $all_orders_list,
           'status' => 200
        ]);
    }
    // order created list api
    public function orderCreatedList()
    {
        $created_orders = ImportData::where('status', '=', 'created')
            ->get();
        return response()->json([
            'data' => $created_orders,
            'message' => 'Created List',
            'status' => 200
        ]);
    }
    // order search by status 
    public function orderSearchList(Request $request) {
        $order_filter_by_status = ImportData::where('status', $request->status)
            ->where('assign_to', $request->delivery_man_id)
            ->get();
        return response()->json([
           'data' => $order_filter_by_status
        ]);
    }
    // order assigned status
    public function orderAssignedStatus(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'product_id' => 'required',
                'delivery_man_id' => 'required',
                'delivery_man_name' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Parameter not found'
            ]);
        }
        $order_id = $request->product_id;
        $orders = ImportData::find($order_id);
        if (strtolower($orders->status) != "created") {
            return response()->json([
                'message' => 'Already Assigned'
            ]);
        }
        $assigned = 'assigned';
        $orders->update([
            'status' => $assigned,
            'assign_to' => $request->delivery_man_id,
            'assigned_name' => $request->delivery_man_name
        ]);
        return response()->json([
            "data" => $orders,
            'message' => 'Assigned',
            'status' => 200
        ]);
    }

    // Delivered API
    public function orderDeliveredStatus(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'product_id' => 'required',
                'received_amount' => 'required',
                'delivery_man_id' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Parameter not found'
            ]);
        }
        $order_id = $request->product_id;
        $orders = ImportData::find($order_id);
        if (strtolower($orders->status) != "assigned") {
           return response()->json([
                'message' => 'Already Delivered'
           ]);
        }
        $orders->update([
            'assign_to' => $request->delivery_man_id,
            'received_amount' => $request->received_amount,
            'status' => 'delivered'
        ]);
        return response()->json([
           'data' => $orders,
           'message' => 'Delivered Successfully',
           'status' => 200
        ]);
    }
    //Return API
    public function orderReturnStatus(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'product_id' => 'required',
                'comments' => 'required',
                'delivery_man_id' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Parameter not found'
            ]);
        }
        $order_id = $request->product_id;
        $orders = ImportData::find($order_id);
        if (strtolower($orders->status) != "assigned") {
            return response()->json([
                'message' => 'Return Product'
            ]);
        }
        $orders->update([
            'assign_to' => $request->delivery_man_id,
            'delivery_comments' => $request->comments,
            'status' => 'returned'
        ]);
        return response()->json([
            'data' => $orders,
            'message' => 'Returned',
            'status' => 200
        ]);
    }
    // Cancel API
    public function orderCancelStatus(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'product_id' => 'required',
                'comments' => 'required',
                'delivery_man_id' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Parameter not found'
            ]);
        }
        $order_id = $request->product_id;
        $orders = ImportData::find($order_id);
        if (strtolower($orders->status) != "assigned") {
            return response()->json([
                'message' => 'Cancel Product'
            ]);
        }
        $orders->update([
            'assign_to' => $request->delivery_man_id,
            'delivery_comments' => $request->comments,
            'status' => 'cancelled'
        ]);
        return response()->json([
            'data' => $orders,
            'message' => 'Cancelled',
//            'status' => 200
        ]);
    }
}
