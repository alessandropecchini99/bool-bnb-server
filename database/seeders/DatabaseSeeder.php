<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ApartmentsTableSeeder::class,
            ServicesTableSeeder::class,
            AddressesTableSeeder::class,
            MessagesTableSeeder::class,
            ImagesTableSeeder::class,
            SponsorshipsTableSeeder::class,
            ApartmentSponsorshipTableSeeder::class,
            ViewsTableSeeder::class,
            ApartmentServiceTableSeeder::class,
        ]);
    }
}
