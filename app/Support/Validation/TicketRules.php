<?php

namespace App\Support\Validation;

class TicketRules
{
    public static function public(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^\+[1-9]\d{6,14}$/'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }


    public static function manager(): array
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
            'status' => ['required', 'in:new,in_progress,processed'],
        ];
    }
}
