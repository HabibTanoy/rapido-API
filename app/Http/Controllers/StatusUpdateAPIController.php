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
             'product_id' => 'required',
             'delivery_man_id' => 'required'
         ]);
         if ($validator->fails()) {
             return response()->json([
                 'message' => 'Parameter not found'
             ]);
         }
        $product_id = $request->product_id;
        $product = ImportData::find($product_id);
        if ($product->status != "created") {
            return response()->json([
                'message' => 'Already Assigned'
            ]);
        }
        $assigned = 'assigned';
        $product->update([
            'status' => $assigned,
           'assign_to' => $request->delivery_man_id
        ]);
        return response()->json([
           "data" => $product,
           'message' => 'Assigned',
           'status' => 200
        ]);
    }
    // Delivered API
    public function deliveredStatus(Request $request)
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
        $product_id = $request->product_id;
        $product = ImportData::find($product_id);
        if ($product->status != "assigned") {
           return response()->json([
                'message' => 'Already Delivered'
           ]);
        }
        $product->update([
            'assign_to' => $request->delivery_man_id,
            'received_amount' => $request->received_amount,
            'status' => 'delivered'
        ]);
        return response()->json([
           'data' => $product,
           'message' => 'Delivered Successfully',
           'status' => 200
        ]);
    }
    //Return API
    public function returnStatus(Request $request)
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
        $product_id = $request->product_id;
        $product = ImportData::find($product_id);
        if ($product->status != "assigned") {
            return response()->json([
                'message' => 'Return Product'
            ]);
        }
        $product->update([
            'assign_to' => $request->delivery_man_id,
            'delivery_comments' => $request->comments,
            'status' => 'returned'
        ]);
        return response()->json([
            'data' => $product,
            'message' => 'Returned',
            'status' => 200
        ]);
    }
    public function cancelStatus(Request $request)
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
        $product_id = $request->product_id;
        $product = ImportData::find($product_id);
        if ($product->status != "assigned") {
            return response()->json([
                'message' => 'Cancel Product'
            ]);
        }
        $product->update([
            'assign_to' => $request->delivery_man_id,
            'delivery_comments' => $request->comments,
            'status' => 'cancelled'
        ]);
        return response()->json([
            'data' => $product,
            'message' => 'Cancelled',
//            'status' => 200
        ]);
    }
}
