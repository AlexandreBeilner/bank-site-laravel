<?php

namespace App\Domain\Billet\Repositories;

use App\Models\Billet;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BilletRepository
{
    public function paginateWithFilters(
        ?string $search,
        int $page,
        int $perPage,
        string $orderBy,
        string $direction
    ): LengthAwarePaginator;

    public function findById(int $id): ?Billet;

    public function create(array $data): Billet;

    public function update(int $id, array $data): Billet;

    public function delete(int $id): void;
}
