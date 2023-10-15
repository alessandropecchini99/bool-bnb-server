<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ApartmentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create();

        $apartmentIds = DB::table('apartments')->pluck('id')->toArray();
        $serviceIds = DB::table('services')->pluck('id')->toArray();

        foreach ($apartmentIds as $apartmentId) {
            // Randomly select a few services to associate with each apartment
            $numberOfServices = $faker->numberBetween(1, 5);
            $selectedServices = $faker->randomElements($serviceIds, $numberOfServices);

            foreach ($selectedServices as $serviceId) {
                DB::table('apartment_service')->insert([
                    'apartment_id' => $apartmentId,
                    'service_id' => $serviceId,
                ]);
            }
        }
    }
}
