<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Song;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run(): void
    {
        $songs = [
            [
                'artist' => 'Ed Sheeran',
                'song_title' => 'Shape of You',
                'song_filename' => 'shape_of_you.mp3',
                'duration' => '3:55',
                'genre' => 'Pop folk-pop soft rock',
            ],
            [
                'artist' => 'Billie Eilish',
                'song_title' => 'Bad Guy',
                'song_filename' => 'bad_guy.mp3',
                'duration' => '3:14',
                'genre' => 'Pop',
            ],
            [
                'artist' => 'Post Malone',
                'song_title' => 'Circles',
                'song_filename' => 'circles.mp3',
                'duration' => '3:35',
                'genre' => 'R & B',
            ],
            [
                'artist' => 'Taylor Swift',
                'song_title' => 'Shake It Off',
                'song_filename' => 'shake_it_off.mp3',
                'duration' => '3:39',
                'genre' => 'Pop country folk rock alternative',
            ],
            [
                'artist' => 'The Weekend',
                'song_title' => 'Blinding Lights',
                'song_filename' => 'blinding_lights.mp3',
                'duration' => '3:20',
                'genre' => 'Pop',
            ],
            [
                'artist' => 'Ed Sheeran',
                'song_title' => 'Photograph',
                'song_filename' => 'photograph.mp3',
                'duration' => '4:00',
                'genre' => 'Pop folk-pop soft rock',
            ],
            [
                'artist' => 'Adele',
                'song_title' => 'Rolling in the Deep',
                'song_filename' => 'rolling_in_the_deep.mp3',
                'duration' => '3:47',
                'genre' => 'Pop soul adult contemporary',
            ],
            [
                'artist' => 'Post Malone',
                'song_title' => 'Sunflower',
                'song_filename' => 'sunflower.mp3',
                'duration' => '2:37',
                'genre' => 'R & B',
            ],
        ];

        foreach ($songs as $songList) {
            Song::create($songList);
        }
    }
}
