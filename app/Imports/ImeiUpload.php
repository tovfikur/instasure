<?php

namespace App\Imports;

use App\Model\ImeiData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImeiUpload implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ImeiData([
            'imei_1'  => $row['imei_1'],
            'imei_2'  => $row['imei_2'],
            'parent_id'  => $row['parent_id'],
            'status'  => $row['status'],
        ]);
    }
}
