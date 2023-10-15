<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Database\Seeder;
use App\Models\ApartmentSponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApartmentSponsorshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $apartmentIds = Apartment::pluck('id')->toArray();
        $sponsorshipIds = Sponsorship::pluck('id')->toArray();

        foreach ($apartmentIds as $apartmentId) {
            $sponsorshipId = $sponsorshipIds[array_rand($sponsorshipIds)];

            $initDate = Carbon::now()->subDays(rand(1, 30));
            $endDate = Carbon::parse($initDate)->addDays(rand(1, 30));

            ApartmentSponsorship::create([
                'apartment_id'   => $apartmentId,
                'sponsorship_id' => $sponsorshipId,
                'init_date'      => $initDate,
                'end_date'       => $endDate,
            ]);
        }
    }
};
