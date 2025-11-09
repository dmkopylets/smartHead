<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    /**
     * Знаходить клієнта за email або створює нового,
     * а також оновлює ім'я та телефон (якщо клієнт існує або тільки-но створений).
     */
    public function upsert(array $customerData): Customer
    {
        $customer = Customer::firstOrCreate(
            ['email' => $customerData['email']],
            [
                'name' => $customerData['name'],
                'phone' => $customerData['phone'],
            ]
        );

        if ($customer->wasRecentlyCreated === false) {
            $customer->update([
                'name' => $customerData['name'],
                'phone' => $customerData['phone'],
            ]);
        }

        return $customer;
    }
}
