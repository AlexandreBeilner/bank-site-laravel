<?php

namespace App\Domain\Billing\Repositories;

use App\Models\BillingInstallment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BillingInstallmentRepository
{

    public function findById(int $id): ?BillingInstallment;

    public function create(array $data): BillingInstallment;

    public function delete(int $id): void;
}
