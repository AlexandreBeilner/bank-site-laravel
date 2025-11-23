<?php

namespace App\Application\Customer\UseCases\UpdateCustomer;

final class UpdateCustomerRequest
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
    ) {}
}
