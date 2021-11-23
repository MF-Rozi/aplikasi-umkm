<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'=> $this->faker->firstName(),
            'last_name'=> $this->faker->lastName(),
            'photo_profile'=> 'placeholder.png',
            'address1'=> $this->faker->address(),
            'address2'=> $this->faker->address(),
            'district'=> $this->faker->city(),
            'province'=> $this->faker->state(),
            'state'=> $this->faker->country(),
            'post_code'=> $this->faker->postcode(),
        ];
    }
}
