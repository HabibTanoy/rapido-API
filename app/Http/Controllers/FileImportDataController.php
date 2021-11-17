<?php

namespace App\Http\Controllers;

use App\Imports\FileImport;
use App\Models\ImportData;
use App\Tools\FetchTraceUsers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class FileImportDataController extends Controller
{
    // view for file import
    public function fileImportExport()
    {
        return view('fileimport');
    }
    // import data for file like(csv)
    public function fileImport(Request $request)
    {
        if (empty($request->file('file')))
        {
            return back()->with('errorMessage','No file selected');
        } else
        {
         Excel::import(new FileImport, $request->file('file')->store('temp'));
            return redirect()->route('order-list')
                ->with('message', 'success');
        }

    }
    // trace api delivery man data information
    public function orderCreateView() {
        $agents = (new FetchTraceUsers())
            ->setApiKey(env('BKOI_TRACE_API_KEY'))
            ->get();
        return view('createDeliveryProduct',compact('agents'));
    }
    // order create by dashboard view
    public function orderCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'price' => 'required',
            'comment' => 'required',
            'create_status' => 'required',
            'create_types' => 'required',
            'agent_id' => 'required'
        ],
        [
            'name.required' => 'Fill up Name',
            'phone.required' => 'Fill up Phone number',
            'address.required' => 'Fill up Address',
            'comment.required' => 'Fill up Comment'
        ]);
        $order_create = ImportData::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'price' => $request->price,
            'comment' => $request->comment,
            'status' => $request->create_status,
            'delivery_types' => $request->create_types,
            'assign_to' => $request->agent_id,
            'assigned_name' => $request->agent_name
        ]);
        return redirect()->route('order-list');
    }

    public function listOfOrder()
    {
        $orders = ImportData::get();
        return view('orderList', compact('orders'));
    }

    //    public function fileExport()
//    {
//        return Excel::download(new UsersExport, 'users-collection.xlsx');
//    }
}
