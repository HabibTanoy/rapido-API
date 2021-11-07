<?php

namespace App\Http\Controllers;

use App\Imports\FileImport;
use App\Models\ImportData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
    public function product_list()
    {
        $list_of_product = ImportData::all();
        return view('taskTableList', compact('list_of_product'));
    }
    //    public function fileExport()
//    {
//        return Excel::download(new UsersExport, 'users-collection.xlsx');
//    }
}
