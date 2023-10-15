<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ViewsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run() {
        $faker = Faker::create();
        for ($i = 1; $i <= 30; $i++) {
            $viewsCount = $faker->numberBetween(500, 1200);
            for ($j = 1; $j <= $viewsCount; $j++) {
                View::create([
                    'apartment_id' => $i,
                    'ip' => $faker->ipv4,
                    'date' => $faker->dateTimeThisYear('now', 'Europe/Rome')->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}

;
