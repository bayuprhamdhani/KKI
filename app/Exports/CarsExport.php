<?php

namespace App\Exports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::select("id", "name", "qty","transmisi", "mileage","price","pict","status")->get();
    }

    public function headings(): array
    {
        return ["ID", "Name", "Quantity", "Transmisi", "Mileage", "Price", "Pict", "Status"];
    }
}
