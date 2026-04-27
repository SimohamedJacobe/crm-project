<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Deal;
use App\Http\Controllers\DealController;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id'           => Company::factory(),
            'contact_id'           => null,
            'title'                => $this->faker->catchPhrase() . ' Deal',
            'amount'               => $this->faker->randomFloat(2, 500, 250000),
            'stage'                => $this->faker->randomElement(DealController::STAGES),
            'expected_close_date'  => $this->faker->optional(0.8)->dateTimeBetween('now', '+12 months')?->format('Y-m-d'),
        ];
    }
}
