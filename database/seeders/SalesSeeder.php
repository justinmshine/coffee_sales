<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sales')->insert([
            [ 
                'quantity' => 1,
                'cost' => 10,
                'sales_price' => 23.33,
                'coffee_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2022-01-01 10:05:00')
            ], 
            [
                'quantity' => 2,
                'cost' => 20.50,
                'sales_price' => 58.24,
                'coffee_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2022-01-02 11:10:00')
            ]
        ]);
    }
}
