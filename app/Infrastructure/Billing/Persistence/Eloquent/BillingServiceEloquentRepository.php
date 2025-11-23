<?php

namespace App\Infrastructure\Billing\Persistence\Eloquent;

use App\Domain\Billing\Repositories\BillingServiceRepository;
use App\Models\BillingService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BillingServiceEloquentRepository implements BillingServiceRepository
{
    public function __construct(
        private BillingService $model
    ) {}


    public function paginateWithFilters(?string $search, int $page, int $perPage, string $orderBy, string $direction): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('customer_id', 'like', "%{$search}%")
                  ->orWhere('bank_id', 'like', "%{$search}%")
                  ->orWhere('total_amount', 'like', "%{$search}%")
                  ->orWhere('installments', 'like', "%{$search}%");
            });
        }

        return $query->orderBy($orderBy, $direction)
                     ->paginate($perPage, ['*'], 'page', $page);
    }

    public function findById(int $id): ?BillingService
    {
        return $this->model->find($id);
    }

    public function create(array $data): BillingService
    {
        return $this->model->create($data);
    }
}
