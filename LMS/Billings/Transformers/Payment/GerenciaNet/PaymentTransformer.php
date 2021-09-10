<?php

namespace LMS\Billings\Transformers\Payment\GerenciaNet;

use Illuminate\Support\Facades\Auth;
use LMS\User\Models\User;

class PaymentTransformer
{
    public function handle(array $payload)
    {
        $user = Auth::user();
        return [
            'payment' => [
                'credit_card' => [
                    'billing_address' => $this->transformAddress($user),
                    'payment_token' => $payload['payment_token'],
                    'customer' => $this->transformCustomer($user)
                ]
            ]
        ];
    }

    private function transformAddress($user): array
    {
        return [
            'street' => $user->address->street,
            'number' => $user->address->number,
            'neighborhood' => $user->address->neighborhood,
            'zipcode' => str_replace('-', '', $user->address->zip_code),
            'city' => $user->address->city,
            'state' => $user->address->state,
        ];
    }

    private function transformCustomer($user): array
    {
        return [
            'name' => $user->name,
            'cpf' => str_replace(['.','-'], '', $user->document_number),
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'birth' => $user->birthdate
        ];
    }
}
