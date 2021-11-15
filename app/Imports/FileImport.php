<?php

namespace App\Imports;

use App\Models\ImportData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FileImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        return new ImportData([
            'name'     => $row[0],
            'phone'    => $row[1],
            'address' => $row[2],
            'delivery_types' => $row[3],
            'price' => $row[4],
            'comment' => $row[5],
            'status' => 'created'
        ]);
    }

}
