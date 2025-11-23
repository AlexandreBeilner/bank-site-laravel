<?php

namespace App\Domain\Billing\Services\Impl;

use App\Application\Billing\useCases\CreateBilling\CreateBillingRequest;
use App\Domain\Billing\Repositories\BillingInstallmentRepository;
use App\Domain\Billing\Repositories\BillingServiceRepository;
use App\Domain\Billing\Services\BillingServiceInterface;
use Carbon\Carbon;

final class BillingService implements BillingServiceInterface
{
    public function __construct(
        private readonly BillingServiceRepository     $billingServiceRepository,
        private readonly BillingInstallmentRepository $billingInstallmentRepository,
    )
    {
    }

    public function create(CreateBillingRequest $dto): void
    {
        $billingService = $this->billingServiceRepository->create([
            'description' => $dto->description,
            'customer_id' => $dto->customer_id,
            'bank_id' => $dto->bank_id,
            'total_amount' => $dto->total_amount,
            'installments' => $dto->installments,
            'first_due_date' => $dto->first_due_date,
            'periodicity' => $dto->periodicity
        ]);

        $this->createInstallments($billingService->id, $dto);
    }

    private function createInstallments(int $billingId, CreateBillingRequest $dto): void
    {
        $amount = $dto->total_amount / $dto->installments;
        $dueDate = Carbon::parse($dto->first_due_date);

        for ($i = 1; $i <= $dto->installments; $i++) {
            $this->billingInstallmentRepository->create([
                'billing_service_id' => $billingId,
                'number' => $i,
                'amount' => $amount,
                'due_date' => $dueDate->copy(),
            ]);

            $dueDate = $this->incrementDate($dueDate, $dto->periodicity);
        }
    }

    private function incrementDate(Carbon $date, string $periodicity): Carbon
    {
        $mapping = [
            'monthly' => fn(Carbon $d) => $d->addMonth(),
            'weekly' => fn(Carbon $d) => $d->addWeek(),
            'daily' => fn(Carbon $d) => $d->addDay(),
        ];

        return $mapping[$periodicity]($date);
    }
}
