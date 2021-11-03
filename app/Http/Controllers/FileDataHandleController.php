<?php

namespace App\Http\Controllers;

use App\Models\ImportData;
use Illuminate\Http\Request;

class FileDataHandleController extends Controller
{
    public function show()
    {
        $importTableData = ImportData::all();
        return view('taskTableList', compact('importTableData'));
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
}
