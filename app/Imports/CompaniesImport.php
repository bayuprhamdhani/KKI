<?php

namespace App\Imports;

use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompaniesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Company([
            'name'     => $row['name'],
            'email'    => $row['email'], 
            'password' => Hash::make($row['password']),
            'address' => $row['address'],
            'logo' => $row['logo'],
            'bank' => $row['bank'],
            'norek' => $row['norek']
        ]);
    }
}
