<?php

namespace App\Domain\Customer\Repositories;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CustomerRepository
{
    public function paginateWithFilters(
        ?string $search,
        int $page,
        int $perPage,
        string $orderBy,
        string $direction
    ): LengthAwarePaginator;

    public function findById(int $id): ?Customer;

    public function create(array $data): Customer;

    public function update(int $id, array $data): Customer;

    public function delete(int $id): void;

    public function findByIdWithBilletCount(int $id): ?Customer;
}
