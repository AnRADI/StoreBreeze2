<?php

namespace Database\Factories;

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
		$this->faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($this->faker));

        return [
            'name' => $this->faker->firstName,
			'image' => $this->faker->imageUrl(300, 300, ['mobile', 'device']),
			'character' => $this->faker->randomElement(['good', 'bad', 'nice', 'angry']),
        ];
    }
}
