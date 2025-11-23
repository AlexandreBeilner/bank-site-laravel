<?php

namespace App\Application\Customer\UseCases\ShowCustomer;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ShowCustomerResponse
{
    public function __construct(
        public readonly ?Customer $customer = null,
    ){}
}
