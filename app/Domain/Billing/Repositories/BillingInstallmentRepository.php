<?php

namespace App\Domain\Billing\Repositories;

use App\Models\BillingInstallment;
use Illuminate\Database\Eloquent\Collection;

interface BillingInstallmentRepository
{

    public function findById(int $id): ?BillingInstallment;

    public function create(array $data): BillingInstallment;

    public function delete(int $id): void;

    public function findPendingForDate(string $date): Collection;

    public function markAsSent(array $ids): void;
}
