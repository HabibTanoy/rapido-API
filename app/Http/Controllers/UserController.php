<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
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
            Excel::import(new UsersImport, $request->file('file')->store('temp'));
            return back()->with('message', 'success');
        }

    }

//    public function fileExport()
//    {
//        return Excel::download(new UsersExport, 'users-collection.xlsx');
//    }
}
