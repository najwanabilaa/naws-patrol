<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdoptionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now()
            ]);
        }

        $adoptions = [
            [
                'user_id' => $user->id,
                'pet_name' => 'Daisy',
                'pet_breed' => 'Persian',
                'pet_location' => 'Jakarta',
                'pet_age' => '2 tahun',
                'pet_color' => 'Putih',
                'pet_gender' => 'Betina',
                'pet_description' => 'Kucing yang sangat jinak dan suka bermain. Sudah divaksin lengkap dan steril.',
                'pet_image' => 'image/kucing.jpg',
                'pet_category' => 'cats',
                'full_name' => 'John Doe',
                'age' => 25,
                'address' => 'Jl. Merdeka No. 123, Jakarta',
                'house_type' => 'Rumah',
                'daily_activity' => 'Bekerja dari rumah',
                'reason' => 'Saya sangat menyukai kucing dan ingin memberikan rumah yang penuh kasih untuk Daisy.',
                'status' => 'pending',
                'submitted_at' => now()->subDays(2)
            ],
            [
                'user_id' => $user->id,
                'pet_name' => 'Max',
                'pet_breed' => 'Golden Retriever',
                'pet_location' => 'Bandung',
                'pet_age' => '3 tahun',
                'pet_color' => 'Emas',
                'pet_gender' => 'Jantan',
                'pet_description' => 'Anjing yang ramah dan aktif. Cocok untuk keluarga dengan anak-anak.',
                'pet_image' => 'image/anjing.png',
                'pet_category' => 'dogs',
                'full_name' => 'Jane Smith',
                'age' => 30,
                'address' => 'Jl. Braga No. 456, Bandung',
                'house_type' => 'Rumah dengan halaman',
                'daily_activity' => 'Bekerja kantoran, pulang sore',
                'reason' => 'Keluarga kami membutuhkan teman bermain untuk anak-anak.',
                'status' => 'approved',
                'submitted_at' => now()->subDays(5),
                'approved_at' => now()->subDays(1)
            ],
            [
                'user_id' => $user->id,
                'pet_name' => 'Luna',
                'pet_breed' => 'Sphynx',
                'pet_location' => 'Surabaya',
                'pet_age' => '1 tahun',
                'pet_color' => 'Krem',
                'pet_gender' => 'Betina',
                'pet_description' => 'Kucing muda yang energik dan suka bermain dengan mainan.',
                'pet_image' => 'image/kucingkrem.jpg',
                'pet_category' => 'cats',
                'full_name' => 'Bob Wilson',
                'age' => 28,
                'address' => 'Jl. Pemuda No. 789, Surabaya',
                'house_type' => 'Apartemen',
                'daily_activity' => 'Freelancer, di rumah sepanjang hari',
                'reason' => 'Saya ingin merawat kucing yang membutuhkan rumah.',
                'status' => 'approved',
                'submitted_at' => now()->subDays(7),
                'approved_at' => now()->subDays(3)
            ],
            [
                'user_id' => $user->id,
                'pet_name' => 'Buddy',
                'pet_breed' => 'Labrador',
                'pet_location' => 'Jakarta',
                'pet_age' => '2 tahun',
                'pet_color' => 'Coklat',
                'pet_gender' => 'Jantan',
                'pet_description' => 'Anjing yang loyal dan mudah dilatih. Sangat cocok untuk pemula.',
                'pet_image' => 'image/anjing2.jpg',
                'pet_category' => 'dogs',
                'full_name' => 'Ahmad Yusuf',
                'age' => 27,
                'address' => 'Jl. Gatot Subroto No. 321, Jakarta',
                'house_type' => 'Rumah',
                'daily_activity' => 'Karyawan swasta',
                'reason' => 'Saya ingin memelihara anjing yang loyal dan mudah dilatih.',
                'status' => 'pending',
                'submitted_at' => now()->subDays(1)
            ]
        ];

        foreach ($adoptions as $adoption) {
            Adoption::create($adoption);
        }
    }
}
