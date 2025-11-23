<?php

namespace App\Domain\Billing\Services;

use App\Application\Billing\useCases\CreateBilling\CreateBillingRequest;

interface BillingServiceInterface
{
    public function create(CreateBillingRequest $dto);
}
