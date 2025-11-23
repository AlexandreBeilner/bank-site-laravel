<?php

namespace App\Application\Customer\UseCases\CreateCustomer;

final class CreateCustomerRequest
{
    public function __construct(
        public string $name,
        public string $email,
    ) {}
}
