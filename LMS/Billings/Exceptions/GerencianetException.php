<?php

namespace LMS\Billings\Exceptions;

use Exception;
use Throwable;

class GerencianetException extends Exception
{
    const GENERIC_ERROR = 3500034;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $data = json_decode($message, true);
        $message = match ($data['code']) {
            self::GENERIC_ERROR => $this->genericErrorHandler($data),
            default => $data['error_description']['message']
        };

        parent::__construct($message, $code, $previous);
    }

    /*
     * code: 3500034
     * error: validation_error (?)
     * error_description: [
     * property: /payment/credit_card/billing_address/zipcode
     * message: A string não corresponde ao modelo: ^[0-9]{8}$."
     * ]
     */

    private function genericErrorHandler(array $payload): string
    {
        $description = $payload['error_description'];
        return match ($payload['error']) {
            'validation_error' => $this->transformValidationError($description),
            default => $description['message']
        };
    }

    /*
     * property: x
     * message: y
     */
    private function transformValidationError(array $description): string
    {
        $properties = explode('/', $description['property']);
        $property = end($properties);

        return match($property) {
            'zipcode' => 'O CEP cadastrado é invalido.',
            'phone_number' => 'O número de telefone cadastrado é invalido.',
            default => 'Houve um problema no campo ' . $property
        };
    }
}
