<?php

namespace App\Http\Requests;

use App\Support\Validation\TicketRules;
use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return TicketRules::public();
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone number must be in E.164 format, for example, +380971234567',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => strtolower($this->email),
        ]);
    }
}
