<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompaniesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::select("id", "name", "email","address", "logo","bank","norek")->get();
    }

    public function headings(): array
    {
        return ["ID", "Name", "Email", "Address", "Logo", "Bank", "No Rekening"];
    }
}
