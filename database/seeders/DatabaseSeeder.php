<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Billet;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         Bank::factory(12)->create();
         Customer::factory(15)->create();
         Billet::factory(20)->create();
    }
}
