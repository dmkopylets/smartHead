<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(6),
            'message' => $this->faker->paragraph(3),
            'status' => $this->faker->randomElement(['new', 'in_progress', 'processed']),
            'manager_replied_at' => $this->faker->optional()->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
