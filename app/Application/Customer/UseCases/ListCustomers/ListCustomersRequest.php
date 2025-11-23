<?php

namespace App\Application\Customer\UseCases\ListCustomers;

final class ListCustomersRequest
{
    public function __construct(
        public ?string $search = null,
        public int $page,
        public int $perPage,
        public string $orderBy,
        public string $direction
    ){}
}
