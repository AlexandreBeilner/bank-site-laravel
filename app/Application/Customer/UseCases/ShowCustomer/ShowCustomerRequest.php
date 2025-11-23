<?php

namespace App\Application\Customer\UseCases\ShowCustomer;

final class ShowCustomerRequest
{
    public function __construct(
        public int $id
    ){}
}
