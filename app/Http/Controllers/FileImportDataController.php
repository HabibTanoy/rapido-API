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
        $agents = (new FetchTraceUsers())
            ->setApiKey(env('BKOI_TRACE_API_KEY'))
            ->get();
//        dd($agents);
        return view('createDeliveryProduct',compact('agents'));
    }
    public function productCreate(Request $request)
    {
        dd($request->all());
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
        $product_create = ImportData::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'price' => $request->price,
            'comment' => $request->comment,
            'status' => $request->create_status,
            'delivery_types' => $request->create_types,
            'assign_to' => $request->agent_id
        ]);
        return redirect()->route('product-list');
    }
    public function product_list()
    {
        $orders = ImportData::get();
        return view('taskTableList', compact('orders'));
    }

    //    public function fileExport()
//    {
//        return Excel::download(new UsersExport, 'users-collection.xlsx');
//    }
}
