<?php

namespace App\Application\Billing\UseCases\CreateBilling;

use App\Domain\Billing\Services\BillingServiceInterface;

final class CreateBillingHandler
{
    public function __construct(private readonly BillingServiceInterface $billingService)
    {
    }

    public function handle(CreateBillingRequest $request): void
    {
        $this->billingService->create($request);
    }
}
