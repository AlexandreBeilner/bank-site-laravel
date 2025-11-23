<?php

namespace App\Infrastructure\Billing\Persistence\Eloquent;

use App\Domain\Billing\Repositories\BillingInstallmentRepository;
use App\Models\BillingInstallment;
use Illuminate\Database\Eloquent\Collection;

class BillingInstallmentEloquentRepository implements BillingInstallmentRepository
{
    public function __construct(
        private BillingInstallment $model
    ) {}

    public function findById(int $id): ?BillingInstallment
    {
        return $this->model->find($id);
    }

    public function create(array $data): BillingInstallment
    {
        return $this->model->create($data);
    }

    public function delete(int $id): void
    {
        $this->model->whereKey($id)->delete();
    }

    public function findPendingForDate(string $date): Collection
    {
        return $this->model
            ->newQuery()
            ->whereDate('due_date', $date)
            ->whereNull('email_sent_at')
            ->get();
    }

    public function markAsSent(array $ids): void
    {
        $this->model->whereIn('id', $ids)->update(['email_sent_at' => now()]);
    }
}
