<?php

namespace App\Application\Customer\UseCases\ListCustomers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ListCustomersResponse
{
    public function __construct(
        public readonly LengthAwarePaginator $paginator
    ){}
}
