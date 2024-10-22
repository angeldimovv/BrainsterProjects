<?php

namespace Database\Factories;

use App\Models\CompanyInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyInfoFactory extends Factory
{
    protected $model = CompanyInfo::class;

    public function definition(): array
    {
        return [
            'hero_image' => $this->faker->url(),
            'social_media' => [
                'facebook' => 'https://www.facebook.com' . $this->faker->word(),
                'twitter' => 'https://www.twitter.com' . $this->faker->word(),
                'instagram' => 'https://www.instagram.com' . $this->faker->word(),
            ],
            'hq_address' => $this->faker->streetAddress(),
            'employees' => $this->faker->randomElements(range(1, 100), $this->faker->numberBetween(1, 50)),
        ];
    }
}
