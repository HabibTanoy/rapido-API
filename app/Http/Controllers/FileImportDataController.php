<?php

namespace App\Http\Controllers;

use App\Imports\FileImport;
use App\Models\ImportData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class FileImportDataController extends Controller
{
    public function fileImportExport()
    {
        return view('fileimport');
    }

    public function fileImport(Request $request)
    {
        if (empty($request->file('file')))
        {
            return back()->with('errorMessage','No file selected');
        } else
        {
         Excel::import(new FileImport, $request->file('file')->store('temp'));
            return redirect()->route('product-list')
                ->with('message', 'success');
        }

    }
    public function productCreateView() {
        return view('createDeliveryProduct');
    }
    public function productCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'price' => 'required',
            'comment' => 'required'
        ],
        [
            'name.required' => 'Fill up Name',
            'phone.required' => 'Fill up Phone number',
            'address.required' => 'Fill up Address',
            'comment.required' => 'Fill up Comment'
        ]);
        $product_create = ImportData::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'price' => $request->price,
            'comment' => $request->comment,
            'status' => 'created'
        ]);
        return redirect()->route('product-list');
    }
    public function product_list()
    {
        $orders = ImportData::get();
        foreach ($orders as $order) {
            $types = $order->delivery_types;
//        dd($types);
            if ($types == "Regular") {
                $order_id = 'RPDR-' . $order->id;
                $order->order_number = $order_id;
            }
            elseif ($types == "Express") {
                $order_id = 'RPDE-' . $order->id;
                $order->order_number = $order_id;
            }
            elseif ($types == "Next Day") {
                $order_id = 'RPDN-' . $order->id;
                $order->order_number = $order_id;
            }
        }
        return view('taskTableList', compact('orders'));
    }
    //    public function fileExport()
//    {
//        return Excel::download(new UsersExport, 'users-collection.xlsx');
//    }
}
