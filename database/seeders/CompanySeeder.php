<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */          
    private $companies = [
        ["TEST1", "TEST1@gmail.com", "123456", "tasikmalaya", 1, "company-logo/test.jpeg", "BCA", "1423243234"],
        ["TEST2", "TEST2@gmail.com", "123456", "bandung", 1, "company-logo/test.jpeg", "BRI", "1423243234"],
        ["TEST3", "TEST3@gmail.com", "123456", "garut", 2, "company-logo/test.jpeg", "Mandiri", "1423243234"],
        ["TEST4", "TEST4@gmail.com", "123456", "ciamis", 1, "company-logo/test.jpeg", "BSI", "1423243234"],
        ["TEST5", "TEST5@gmail.com", "123456", "majalengka", 1, "company-logo/test.jpeg", "BCA", "1423243234"],
        ["TEST6", "TEST6@gmail.com", "123456", "kuningan", 2, "company-logo/test.jpeg", "BRI", "1423243234"],
        ["TEST7", "TEST7@gmail.com", "123456", "jakarta", 1, "company-logo/test.jpeg", "Mandiri", "1423243234"],
        ["TEST8", "TEST8@gmail.com", "123456", "bogor", 2, "company-logo/test.jpeg", "BSI", "1423243234"],
    ];

    public function run(): void
    {
        foreach ($this->companies as $company) {
            \App\Models\Company::create([
                "name" => $company[0],
                "email" => $company[1],
                "password" => $company[2],
                "address" => $company[3],
                "status" => $company[4],
                "logo" => $company[5],
                "bank" => $company[6],
                "norek" => $company[7],
            ]);
        }
    }
}
