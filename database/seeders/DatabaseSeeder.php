<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(BankSeeder::class);
        $this->call(ChartSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(SubdistrictSeeder::class);
        $this->call(CardTypeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(TransmisiSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(CarSeeder::class);
        $this->call(TransactionSeeder::class);

    }
}
