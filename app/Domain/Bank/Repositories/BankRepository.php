<?php

namespace App\Domain\Bank\Repositories;

use App\Models\Bank;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BankRepository
{
    public function paginateWithFilters(
        ?string $search,
        int $page,
        int $perPage,
        string $orderBy,
        string $direction
    ): LengthAwarePaginator;

    public function findById(int $id): ?Bank;

    public function create(array $data): Bank;

    public function update(int $id, array $data): Bank;

    public function delete(int $id): void;

    public function findByIdWithBilletCount(int $id): ?Bank;
}
