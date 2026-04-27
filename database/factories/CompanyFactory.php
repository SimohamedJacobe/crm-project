<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'    => $this->faker->company(),
            'email'   => $this->faker->unique()->companyEmail(),
            'phone'   => $this->faker->phoneNumber(),
            'website' => $this->faker->url(),
            'address' => $this->faker->streetAddress() . ', '
                       . $this->faker->city() . ', '
                       . $this->faker->stateAbbr() . ' '
                       . $this->faker->postcode() . ', '
                       . $this->faker->country(),
        ];
    }
}
