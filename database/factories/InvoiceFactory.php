<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['paid', 'billed', 'void']);
        return [
            'customer_id' => \App\Models\Customer::factory(),
            'amount' => $this->faker->numberBetween(100, 1000),
            'status' => $status,
            'billed_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'paid_date' => $status  == 'paid' ? $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d') : null,      
            
        ];
    }
}
