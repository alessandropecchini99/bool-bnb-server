<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class ImagesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run() {
        $apartmentCount = 30;
        $imagesPerApartment = 5;
        $imageCount = 150;

        for ($i = 1; $i <= $apartmentCount; $i++) {
            $imagePaths = [];

            for ($j = 1; $j <= $imagesPerApartment; $j++) {
                $isCover = ($j === 1); // Set the first image as cover

                $imageIndex = ($i - 1) * $imagesPerApartment + $j + 5; // Starting from img_6.webp
                $imagePath = "uploads/img_{$imageIndex}.webp";
                $imagePaths[] = $imagePath;

                DB::table('images')->insert([
                    'apartment_id' => $i,
                    'is_cover' => $isCover,
                    'image_path' => $imagePath,
                ]);

                $isCover = false;
            }
        }
    }
}

;
