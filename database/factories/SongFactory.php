<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $storageAudioPath = storage_path('app/public/audio');
        $files = File::files($storageAudioPath);

        if (empty($files)) {
            $filePath = 'audio/default.mp3';
        } else {
            $file = $this->faker->randomElement($files);
            $filePath = 'audio/' . $file->getFilename();
        }

        // Define a list of possible music genres
        $genres = ['Classical', 'Pop', 'Rock', 'Hip-hop', 'Electronic', 'Jazz'];

        //Generate the song title, description, genre and release_date with random values, using the defined restrictions

        return [
            'title' => fake()->unique()->sentence(4),
            'description' => fake()->text,
            'genre' => $this->faker->randomElement($genres), // Randomly selects a genre from the predefined list
            'release_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'audio_file_path' => $filePath,
        ];
    }
}
