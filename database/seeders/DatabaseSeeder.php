<?php
namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Demo Seller',
            'email' => 'demo@example.com',
            'phone' => '+2348000000000',
            'password' => Hash::make('password'),
        ]);

        $car = Car::create([
            'user_id' => $user->id,
            'maker' => 'Lexus',
            'model' => 'RX200t',
            'year' => 2016,
            'car_type' => 'suv',
            'fuel_type' => 'gasoline',
            'price' => 25000,
            'mileage' => 45000,
            'state' => 'Lagos',
            'city' => 'Ikeja',
            'description' => 'A clean demo vehicle imported from the original static website design.',
            'features' => ['air_conditioning','power_windows','abs','bluetooth_connectivity','gps_navigation','leather_seats'],
            'published' => true,
        ]);
        $car->images()->create(['path' => 'cars/demo/1.jpeg', 'position' => 1]);
    }
}