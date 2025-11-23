<?php

namespace App\Domain\Billing\Repositories;

use App\Models\BillingService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BillingServiceRepository
{
    public function paginateWithFilters(
        ?string $search,
        int $page,
        int $perPage,
        string $orderBy,
        string $direction
    ): LengthAwarePaginator;

    public function findById(int $id): ?BillingService;

    public function create(array $data): BillingService;
}
