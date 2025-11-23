<?php

namespace App\Infrastructure\Customer\Persistence\Eloquent;

use App\Domain\Customer\Repositories\CustomerRepository;
use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerEloquentRepository implements CustomerRepository
{
    public function __construct(
        private Customer $model
    ) {}


    public function paginateWithFilters(?string $search, int $page, int $perPage, string $orderBy, string $direction): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($search) {
            $search = strtolower($search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->orderBy($orderBy, $direction)
                     ->paginate($perPage, ['*'], 'page', $page);
    }

    public function findById(int $id): ?Customer
    {
        return $this->model->find($id);
    }

    public function create(array $data): Customer
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Customer
    {
        $customer = $this->model->findOrFail($id);

        $customer->update($data);

        return $customer;
    }

    public function delete(int $id): void
    {
        $this->model->whereKey($id)->delete();
    }

    public function findByIdWithBilletCount(int $id): ?Customer
    {
        return $this->model->withCount('billets')->find($id);
    }
}
