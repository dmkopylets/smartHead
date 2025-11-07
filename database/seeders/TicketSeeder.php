<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Customer;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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
    }
}
