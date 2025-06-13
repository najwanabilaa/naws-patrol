<?php

namespace Database\Seeders;

use App\Models\FosterHome;
use App\Models\User;    
use Illuminate\Database\Seeder;

class FosterHomeSeeder extends Seeder
{
    public function run()
    {
        $fosterHomes = [
            [
                'user_id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '08123456789',
                'address' => '123 Main St',
                'animal_types' => ['cat', 'dog'],
                'capacity' => 3,
                'experience' => '2 years',
                'status' => 'approved',
                'approved_at' => now(),
            ],
            [
                'user_id' => 2,
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '08987654321',
                'address' => '456 Elm St',
                'animal_types' => ['dog'],
                'capacity' => 2,
                'experience' => '1 year',
                'status' => 'pending',
                'approved_at' => null,
            ],
            [
                'user_id' => 3,
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'phone' => '08555123456',
                'address' => '789 Oak Ave',
                'animal_types' => ['cat'],
                'capacity' => 1,
                'experience' => '3 years',
                'status' => 'approved',
                'approved_at' => now(),
            ]
        ];

        foreach ($fosterHomes as $fosterHome) {
            FosterHome::create($fosterHome);
        }
    }
}
