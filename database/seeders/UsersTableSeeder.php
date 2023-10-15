<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $users = [
            [
                'name'       => 'Mario',
                'last_name'  => 'Rossi',
                'email'      => 'rossi@gmail.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Maria',
                'last_name'  => 'Rossi',
                'email'      => 'maria.rossi@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Luca',
                'last_name'  => 'Bianchi',
                'email'      => 'luca.bianchi@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Stefania',
                'last_name'  => 'Neri',
                'email'      => 'stefania.neri@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Roberto',
                'last_name'  => 'Esposito',
                'email'      => 'roberto.esposito@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Giulia',
                'last_name'  => 'Ferrari',
                'email'      => 'giulia.ferrari@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Francesco',
                'last_name'  => 'Conti',
                'email'      => 'francesco.conti@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Sara',
                'last_name'  => 'Romano',
                'email'      => 'sara.romano@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Davide',
                'last_name'  => 'Colombo',
                'email'      => 'davide.colombo@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Elena',
                'last_name'  => 'Ricci',
                'email'      => 'elena.ricci@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Michele',
                'last_name'  => 'Bruno',
                'email'      => 'michele.bruno@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Chiara',
                'last_name'  => 'Galli',
                'email'      => 'chiara.galli@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Carlo',
                'last_name'  => 'Costa',
                'email'      => 'carlo.costa@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Laura',
                'last_name'  => 'Testa',
                'email'      => 'laura.testa@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Simone',
                'last_name'  => 'Serra',
                'email'      => 'simone.serra@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Daniela',
                'last_name'  => 'Barbieri',
                'email'      => 'daniela.barbieri@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Giuseppe',
                'last_name'  => 'Marino',
                'email'      => 'giuseppe.marino@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Anna',
                'last_name'  => 'Fontana',
                'email'      => 'anna.fontana@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Giovanni',
                'last_name'  => 'Moretti',
                'email'      => 'giovanni.moretti@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Beatrice',
                'last_name'  => 'Martini',
                'email'      => 'beatrice.martini@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
            [
                'name'       => 'Fabio',
                'last_name'  => 'Rizzo',
                'email'      => 'fabio.rizzo@example.com',
                'password'   => Hash::make('admin12345'),
                'birth_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023')->format('Y-m-d'),
            ],
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
