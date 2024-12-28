<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel, WithHeadingRow
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
            'contact' => $row['contact'],
            'country' => $row['country'],
            'province' => $row['province'],
            'city' => $row['city'],
            'subdistrict' => $row['subdistrict'],
            'postal_code' => $row['postal_code'],
            'card_type' => $row['card_type'],
            'card_number' => $row['card_number'],
            'card_owner' => $row['card_owner'],
            'card_expired' => $row['card_expired'],
            'cvv' => $row['cvv'],
        ]);
    }
}
