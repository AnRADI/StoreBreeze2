<?php

namespace Database\Factories;

use App\Services\Faker\Provider\Unsplash;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

		$this->faker->addProvider(new Unsplash($this->faker));


        return [
            'name' => $this->faker->firstName,
			'image' => $this->faker->imageUrl(300, 300, ['cat']),
			'character' => $this->faker->randomElement(['good', 'bad', 'nice', 'angry']),
        ];
    }
}
