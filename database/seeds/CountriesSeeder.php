<?php

use Illuminate\Database\Seeder;
use App\Models\Countries;

class CountriesSeeder extends Seeder
{
    public function run()
    {
    	$countries = config('sensorization.seeds.countries');

        foreach ($countries as $country) {
            Countries::firstOrCreate([
                'name' => $country
            ]);
        }
    }
}
