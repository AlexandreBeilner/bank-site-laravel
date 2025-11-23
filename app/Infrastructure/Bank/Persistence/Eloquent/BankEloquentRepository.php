<?php

namespace App\Infrastructure\Bank\Persistence\Eloquent;

use App\Domain\Bank\Repositories\BankRepository;
use App\Models\Bank;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BankEloquentRepository implements BankRepository
{
    public function __construct(
        private Bank $model
    ) {}


    public function paginateWithFilters(?string $search, int $page, int $perPage, string $orderBy, string $direction): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($search) {
            $search = strtolower($search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('interest_rate', 'like', "%{$search}%");
            });
        }

        return $query->orderBy($orderBy, $direction)
                     ->paginate($perPage, ['*'], 'page', $page);
    }

    public function findById(int $id): ?Bank
    {
        return $this->model->find($id);
    }

    public function create(array $data): Bank
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Bank
    {
        $customer = $this->model->findOrFail($id);

        $customer->update($data);

        return $customer;
    }

    public function delete(int $id): void
    {
        $this->model->whereKey($id)->delete();
    }

    public function findByIdWithBilletCount(int $id): ?Bank
    {
        return $this->model->withCount('billets')->find($id);
    }
}
