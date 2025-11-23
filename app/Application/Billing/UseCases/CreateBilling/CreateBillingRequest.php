<?php

namespace App\Application\Billing\UseCases\CreateBilling;

final class CreateBillingRequest
{
    public function __construct(
        public string $description,
        public int $customer_id,
        public int $bank_id,
        public float $total_amount,
        public int $installments,
        public string $first_due_date,
        public string $periodicity,
    )
    {
    }
}
