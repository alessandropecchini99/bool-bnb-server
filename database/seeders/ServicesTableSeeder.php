<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $services = [
            [
                'name' => 'Air conditioning',
                'icon' => 'fa-solid fa-fan',
            ],
            [
                'name' => 'Bed linens',
                'icon' => 'fa-solid fa-bed',
            ],
            [
                'name' => 'Kitchen',
                'icon' => 'fa-solid fa-utensils',
            ],
            [
                'name' => 'Garden',
                'icon' => 'fa-solid fa-seedling',
            ],
            [
                'name' => 'Dishwasher',
                'icon' => 'fa-solid fa-hand-sparkles',
            ],
            [
                'name' => 'Washing machine',
                'icon' => 'fa-solid fa-shirt',
            ],
            [
                'name' => 'Free parking',
                'icon' => 'fa-solid fa-square-parking',
            ],
            [
                'name' => 'Pool',
                'icon' => 'fa-solid fa-swimming-pool',
            ],
            [
                'name' => 'TV',
                'icon' => 'fa-solid fa-tv',
            ],
            [
                'name' => 'Bathtub',
                'icon' => 'fa-solid fa-bathtub',
            ],
            [
                'name' => 'Panoramic view',
                'icon' => 'fa-solid fa-binoculars',
            ],
            [
                'name' => 'Wi-Fi',
                'icon' => 'fa-solid fa-wifi',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
};

