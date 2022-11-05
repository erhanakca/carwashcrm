<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_id' => rand(1, 10),
            'customer_id' => rand(1, 10),
            'user_id' => rand(1, 10),
            'status' => rand(1, 3),
            'vehicle_type_id' => rand(1, 6),
            'plate_number' => fake()->randomElement(['34ZS4523', '41TY9632', '56FG7896', '41OKT689', '42BRO365']),
            'start_date' => fake()->dateTimeBetween('now', '+3 hour')->format('Y-m-d H:i:s'),
            'end_date' => fake()->dateTimeBetween('+4 haur', '+1 day')->format('Y-m-d H:i:s'),
        ];
    }
}
