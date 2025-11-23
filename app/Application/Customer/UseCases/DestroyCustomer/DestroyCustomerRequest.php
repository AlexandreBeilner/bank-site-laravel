<?php

namespace App\Application\Customer\UseCases\DestroyCustomer;

final class DestroyCustomerRequest
{
    public function __construct(
        public int $id
    ) {}
}
