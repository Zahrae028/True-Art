<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test client
        $client = User::create([
            'name' => 'Alex Rivera',
            'email' => 'client@test.com',
            'password' => bcrypt('12345678'),
            'role' => 'client',
        ]);
        $client->profile()->create([
            'bio' => 'An avid collector of digital landscapes and concept art.',
        ]);

        // Create several professional artists
        $artists = [
            [
                'name' => 'Elena Thorne',
                'email' => 'elena@test.com',
                'specialty' => 'Concept Art',
                'bio' => 'Specializing in dark fantasy environments and atmospheric lighting. Over 8 years of experience in the gaming industry.',
            ],
            [
                'name' => 'Kaelen Vance',
                'email' => 'kaelen@test.com',
                'specialty' => 'Character Design',
                'bio' => 'Creating unique, expressive characters for RPGs and animated series. Love working on sci-fi and cyberpunk aesthetics.',
            ],
            [
                'name' => 'Sora Moon',
                'email' => 'sora@test.com',
                'specialty' => 'Illustrator',
                'bio' => 'Vibrant, anime-inspired illustrations with a focus on emotional storytelling and dynamic compositions.',
            ],
            [
                'name' => 'Marcus Flint',
                'email' => 'artist@test.com',
                'specialty' => '3D Sculpting',
                'bio' => 'High-detail 3D character sculpts and printable miniatures. Expert in ZBrush and Substance Painter.',
            ],
        ];

        foreach ($artists as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('12345678'),
                'role' => 'artist',
            ]);
            
            $user->profile()->create([
                'specialty' => $data['specialty'],
                'bio' => $data['bio'],
                'projects_completed' => rand(15, 60),
                'rating' => rand(45, 50) / 10,
                'response_rate' => rand(90, 100),
                'avatar' => 'https://i.pravatar.cc/150?u=' . $user->email,
            ]);
        }

        // Create a system administrator
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
    }
}
