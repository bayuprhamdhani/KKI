<?php

namespace App\Imports;

use App\Models\Car;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CarsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Car([
            'name'     => $row['name'],
            'qty'    => $row['qty'], 
            'transmisi' => $row['transmisi'],
            'mileage' => $row['mileage'],
            'price' => $row['price'],
            'pict' => $row['pict'],
            'status' => $row['status'],

        ]);
    }
}