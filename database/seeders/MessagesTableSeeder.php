<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 60; $i++) {
            $guestName = $faker->name;
            $guestEmail = $faker->unique()->safeEmail;
            $randApartmentId = random_int(1, 30);
            $message = new Message([
                'apartment_id' => $randApartmentId,
                'guest_email' => $guestEmail,
                'guest_name' => $guestName,
                'message' => $faker->realText(100),
            ]);
            $message->save();
        }

        $messages = [
            [
                'apartment_id' => 1,
                'guest_email'   => 'john.doe@example.com',
                'guest_name'         => 'John Doe',
                'message'      => 'Is this apartment available for the dates from August 10th to August 20th?',
            ],
            [
                'apartment_id' => 2,
                'guest_email'   => 'jane.smith@example.com',
                'guest_name'         => 'Jane Smith',
                'message'      => 'What\'s the policy on pets? Can I bring my small dog with me?',
            ],
            [
                'apartment_id' => 3,
                'guest_email'   => 'sam.johnson@example.com',
                'guest_name'         => 'Sam Johnson',
                'message'      => 'Are there any good hiking trails near the apartment?',
            ],
            [
                'apartment_id' => 4,
                'guest_email'   => 'emily.wilson@example.com',
                'guest_name'         => 'Emily Wilson',
                'message'      => 'Is there a minimum stay requirement for this apartment?',
            ],
            [
                'apartment_id' => 5,
                'guest_email'   => 'michael.davis@example.com',
                'guest_name'         => 'Michael Davis',
                'message'      => 'Can you provide more details about public transportation options in the area?',
            ],
            [
                'apartment_id' => 6,
                'guest_email'   => 'olivia.jones@example.com',
                'guest_name'         => 'Olivia Jones',
                'message'      => 'What\'s the check-in and check-out time for this apartment?',
            ],
            [
                'apartment_id' => 7,
                'guest_email'   => 'william.brown@example.com',
                'guest_name'         => 'William Brown',
                'message'      => 'Is there a parking space available for guests?',
            ],
            [
                'apartment_id' => 8,
                'guest_email'   => 'sophia.miller@example.com',
                'guest_name'         => 'Sophia Miller',
                'message'      => 'Do you offer any discounts for longer stays?',
            ],
            [
                'apartment_id' => 9,
                'guest_email'   => 'james.anderson@example.com',
                'guest_name'         => 'James Anderson',
                'message'      => 'Are there any good restaurants within walking distance?',
            ],
            [
                'apartment_id' => 10,
                'guest_email'   => 'oliver.wilson@example.com',
                'guest_name'         => 'Oliver Wilson',
                'message'      => 'What\'s the nearest metro station to the apartment?',
            ],
            [
                'apartment_id' => 11,
                'guest_email'   => 'liam.wilson@example.com',
                'guest_name'         => 'Liam Wilson',
                'message'      => 'Is there a security deposit required for the apartment?',
            ],
            [
                'apartment_id' => 12,
                'guest_email'   => 'ava.anderson@example.com',
                'guest_name'         => 'Ava Anderson',
                'message'      => 'Is smoking allowed in the apartment?',
            ],
            [
                'apartment_id' => 13,
                'guest_email'   => 'noah.jackson@example.com',
                'guest_name'         => 'Noah Jackson',
                'message'      => 'Are there any local events or festivals happening during my stay?',
            ],
            [
                'apartment_id' => 14,
                'guest_email'   => 'mia.smith@example.com',
                'guest_name'         => 'Mia Smith',
                'message'      => 'Is there a gym or fitness center nearby?',
            ],
            [
                'apartment_id' => 15,
                'guest_email'   => 'logan.johnson@example.com',
                'guest_name'         => 'Logan Johnson',
                'message'      => 'Can you recommend any nearby tourist attractions?',
            ],
            [
                'apartment_id' => 16,
                'guest_email'   => 'chloe.davis@example.com',
                'guest_name'         => 'Chloe Davis',
                'message'      => 'Is there a cleaning fee for the apartment?',
            ],
            [
                'apartment_id' => 17,
                'guest_email'   => 'ethan.brown@example.com',
                'guest_name'         => 'Ethan Brown',
                'message'      => 'Do you provide airport transportation services?',
            ],
            [
                'apartment_id' => 18,
                'guest_email'   => 'luna.wilson@example.com',
                'guest_name'         => 'Luna Wilson',
                'message'      => 'What\'s the cancellation policy for this apartment?',
            ],
            [
                'apartment_id' => 19,
                'guest_email'   => 'oliver.miller@example.com',
                'guest_name'         => 'Oliver Miller',
                'message'      => 'Is there a balcony with a view in the apartment?',
            ],
            [
                'apartment_id' => 20,
                'guest_email'   => 'lily.jones@example.com',
                'guest_name'         => 'Lily Jones',
                'message'      => 'Are there any nearby shopping malls or markets?',
            ],
            [
                'apartment_id' => 21,
                'guest_email'   => 'benjamin.davis@example.com',
                'guest_name'         => 'Benjamin Davis',
                'message'      => 'Is there a grocery store within walking distance?',
            ],
            [
                'apartment_id' => 22,
                'guest_email'   => 'emily.anderson@example.com',
                'guest_name'         => 'Emily Anderson',
                'message'      => 'What\'s the policy on late check-in or early check-out?',
            ],
            [
                'apartment_id' => 23,
                'guest_email'   => 'henry.martin@example.com',
                'guest_name'         => 'Henry Martin',
                'message'      => 'Are there any nearby parks or recreational areas?',
            ],
            [
                'apartment_id' => 24,
                'guest_email'   => 'sophia.taylor@example.com',
                'guest_name'         => 'Sophia Taylor',
                'message'      => 'Is there a shuttle service to the airport?',
            ],
            [
                'apartment_id' => 25,
                'guest_email'   => 'william.wilson@example.com',
                'guest_name'         => 'William Wilson',
                'message'      => 'Do you offer any special discounts for families with children?',
            ],
            [
                'apartment_id' => 26,
                'guest_email'   => 'zoey.miller@example.com',
                'guest_name'         => 'Zoey Miller',
                'message'      => 'Is there a dishwasher in the apartment?',
            ],
            [
                'apartment_id' => 27,
                'guest_email'   => 'daniel.anderson@example.com',
                'guest_name'         => 'Daniel Anderson',
                'message'      => 'Is there a coffee maker in the kitchen?',
            ],
            [
                'apartment_id' => 28,
                'guest_email'   => 'olivia.martin@example.com',
                'guest_name'         => 'Olivia Martin',
                'message'      => 'Is there a swimming pool in the apartment complex?',
            ],
            [
                'apartment_id' => 29,
                'guest_email'   => 'ethan.taylor@example.com',
                'guest_name'         => 'Ethan Taylor',
                'message'      => 'What\'s the internet speed and connectivity like in the apartment?',
            ],
            [
                'apartment_id' => 30,
                'guest_email'   => 'ava.johnson@example.com',
                'guest_name'         => 'Ava Johnson',
                'message'      => 'Is there a nearby pharmacy or medical facility?',
            ],
        ];

        foreach ($messages as $message) {
            Message::create($message);
        }
    }
};
