<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Customer;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();

        if ($customers->isEmpty()) {
            $this->call(CustomerSeeder::class);
            $customers = Customer::all();
        }

        foreach ($customers as $customer) {
            Ticket::factory()->count(rand(1, 3))->create([
                'customer_id' => $customer->id,
            ]);
        }

        $customer = $customers->random();

        // Емуляція трьох періодів
        Ticket::factory()->count(3)->create([
            'customer_id' => $customer->id,
            'created_at' => now(),
        ]);

        Ticket::factory()->count(5)->create([
            'customer_id' => $customer->id,
            'created_at' => now()->subDays(3),
        ]);

        Ticket::factory()->count(10)->create([
            'customer_id' => $customer->id,
            'created_at' => now()->subDays(20),
        ]);
    }
}
