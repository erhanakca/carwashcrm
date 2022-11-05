<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Job;
use App\Models\Service;
use App\Models\User;
use App\Models\VehicleType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();

        DB::table('vehicle_types')->insert([
            'name' => 'Sedan',
            'price_multiplier' => 20,
            'created_at' => Carbon::now()
        ]);
        DB::table('vehicle_types')->insert([
            'name' => 'Hatchback',
            'price_multiplier' => null,
            'created_at' => Carbon::now()
        ]);
        DB::table('vehicle_types')->insert([
            'name' => 'Station Vagon',
            'price_multiplier' => 30,
            'created_at' => Carbon::now()
        ]);
        DB::table('vehicle_types')->insert([
            'name' => 'Cabrio',
            'price_multiplier' => null,
            'created_at' => Carbon::now()
        ]);
        DB::table('vehicle_types')->insert([
            'name' => 'Pick Up',
            'price_multiplier' => 50,
            'created_at' => Carbon::now()
        ]);
        DB::table('vehicle_types')->insert([
            'name' => 'Suv',
            'price_multiplier' => 40,
            'created_at' => Carbon::now()
        ]);


        Customer::factory()->count(10)->create();
        Service::factory()->count(10)->create();
        Job::factory()->count(10)->create();

    }
}
