<?php

namespace App\Imports;

use App\Models\Csv;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Imports\csv_datas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return Csv
     */
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new Csv([
            'name'     => $row[0],
            'phone'    => $row[1],
            'address' => $row[2],
            'price' => $row[3],
            'comment' => $row[4]
        ]);
    }
}
