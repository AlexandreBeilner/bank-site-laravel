<?php

namespace App\Application\Bank\UseCases\UpdateBank;

use App\Domain\Bank\Repositories\BankRepository;

final class UpdateBankHandler
{
    public function __construct(
        private readonly BankRepository $bankRepository
    )
    {
    }

    public function handle(UpdateBankRequest $request): void
    {
        $this->bankRepository->update($request->id, [
            'name' => $request->name,
            'code' => $request->code,
            'interest_rate' => $request->interest_rate
        ]);
    }
}

