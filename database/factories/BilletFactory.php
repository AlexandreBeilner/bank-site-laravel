<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Billet>
 */
class BilletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payer_name'         => $this->faker->name(),
            'payer_document'     => $this->faker->numerify('###########'),
            'recipient_name'     => $this->faker->company(),
            'recipient_document' => $this->faker->numerify('###########'),
            'amount'             => $this->faker->randomFloat(2, 10, 10000),
            'expiration_date'    => $this->faker->dateTimeBetween('now', '+1 year'),
            'observations'       => $this->faker->optional()->sentence(),
            'customer_id'        => Customer::factory(),
            'bank_id'            => Bank::factory(),
        ];
    }
}
