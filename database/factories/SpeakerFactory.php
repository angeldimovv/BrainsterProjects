<?php

namespace Database\Factories;

use App\Enum\SpeakerType;
use App\Models\Speaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SpeakerFactory extends Factory
{
    protected $model = Speaker::class;

    public function definition(): array
    {
        $first_name = $this->faker->firstName();
        return [
            'first_name' => $first_name,
            'last_name' => $this->faker->lastName(),
            'title' => $this->faker->title(),
            'type' => $this->faker->randomElement(SpeakerType::toArray()),
            'social_media' => json_encode([
                'twitter' => 'https:://twitter.com/' . $this->faker->word(),
                'linkedin' => 'https:://linkedin.com/' . $this->faker->word(),
                'facebook' => 'https:://facebook.com/' . $this->faker->word(),
                'instagram' => 'https:://instagram.com/' . $this->faker->word(),
            ]),
            'photo' => 'https://ui-avatars.com/api/?background=111111&color=fff&length=1&font-size=0.65&format=svg&name=' . $first_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
