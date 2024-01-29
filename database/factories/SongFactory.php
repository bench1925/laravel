<?php

namespace Database\Factories;

use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
{
    protected $model = Song::class;

    public function definition()
    {
        return [
            'artist' => $this->faker->name,
            'song_title' => $this->faker->word,
            'song_filename' => $this->faker->word,
            'duration' => $this->faker->randomNumber($nbDigits = 2), // Assuming a two-digit duration,
            'genre' => $this->faker->name,
        ];
    }
}
