<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    public function run(): void
    {
        $animals = [
            [
                'name' => 'Daisy',
                'type' => 'cats',
                'breed' => 'Persian',
                'location' => 'Jakarta',
                'age' => '2 tahun',
                'color' => 'Putih',
                'gender' => 'Betina',
                'description' => 'Kucing yang sangat jinak dan suka bermain. Sudah divaksin lengkap dan steril.',
                'image_path' => 'image/kucing.jpg',
                'status' => 'available'
            ],
            [
                'name' => 'Luna',
                'type' => 'cats',
                'breed' => 'Sphynx',
                'location' => 'Surabaya',
                'age' => '1 tahun',
                'color' => 'Krem',
                'gender' => 'Betina',
                'description' => 'Kucing muda yang energik dan suka bermain dengan mainan.',
                'image_path' => 'image/kucingkrem.jpg',
                'status' => 'available'
            ],
            [
                'name' => 'Bella',
                'type' => 'dogs',
                'breed' => 'Beagle',
                'location' => 'Yogyakarta',
                'age' => '1.5 tahun',
                'color' => 'Tricolor',
                'gender' => 'Betina',
                'description' => 'Anjing yang ceria dan suka bermain. Sangat aktif dan sehat.',
                'image_path' => 'image/anjing2.jpg',
                'status' => 'available'
            ],
            [
                'name' => 'Rocky',
                'type' => 'dogs',
                'breed' => 'German Shepherd',
                'location' => 'Surabaya',
                'age' => '4 tahun',
                'color' => 'Coklat',
                'gender' => 'Jantan',
                'description' => 'Anjing yang pintar dan protective. Cocok untuk penjagaan rumah.',
                'image_path' => 'image/anjing.png',
                'status' => 'available'
            ],
            [
                'name' => 'Sunny',
                'type' => 'birds',
                'breed' => 'Kenari',
                'location' => 'Bandung',
                'age' => '1 tahun',
                'color' => 'Kuning',
                'gender' => 'Betina',
                'description' => 'Burung kenari dengan suara merdu. Sangat cocok untuk pemula.',
                'image_path' => 'image/bird.jpeg',
                'status' => 'available'
            ],
            [
                'name' => 'Coco',
                'type' => 'birds',
                'breed' => 'Cockatiel',
                'location' => 'Malang',
                'age' => '1.5 tahun',
                'color' => 'Hijau',
                'gender' => 'Betina',
                'description' => 'Burung cockatiel yang ramah dan suka berinteraksi dengan manusia.',
                'image_path' => 'image/bird2.jpg',
                'status' => 'available'
            ],
            [
                'name' => 'Mango',
                'type' => 'birds',
                'breed' => 'Kakatua',
                'location' => 'Semarang',
                'age' => '10 bulan',
                'color' => 'Putih',
                'gender' => 'Betina',
                'description' => 'Kakatua dengan warna orange yang cantik. Sangat aktif dan sehat.',
                'image_path' => 'image/bird1.jpg',
                'status' => 'available'
            ],

            [
                'name' => 'Snow',
                'type' => 'rabbits',
                'breed' => 'Angora',
                'location' => 'Semarang',
                'age' => '2 tahun',
                'color' => 'Coklat',
                'gender' => 'Betina',
                'description' => 'Kelinci angora dengan bulu yang sangat halus. Sangat jinak dan tenang.',
                'image_path' => 'image/rabbit3.jpg',
                'status' => 'available'
            ],
            [
                'name' => 'Hazel',
                'type' => 'rabbits',
                'breed' => 'Mini Rex',
                'location' => 'Yogyakarta',
                'age' => '1.5 tahun',
                'color' => 'Coklat Muda',
                'gender' => 'Betina',
                'description' => 'Kelinci dengan bulu yang lembut seperti beludru. Sangat ramah.',
                'image_path' => 'image/rabbit2.jpg',
                'status' => 'available'
            ]
        ];

        foreach ($animals as $animal) {
            Animal::create($animal);
        }
    }
}
