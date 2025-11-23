<?php

namespace App\Application\Billing\UseCases\ListBillings;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ListBillingsResponse
{
    public function __construct(
        public readonly LengthAwarePaginator $paginator
    ){}
}
