<?php

namespace App\Application\Bank\UseCases\CreateBank;

use App\Domain\Bank\Repositories\BankRepository;

final class CreateBankHandler
{
    public function __construct(
        private readonly BankRepository $bankRepository
    )
    {
    }

    public function handle(CreateBankRequest $request): void
    {
        $this->bankRepository->create([
            'name' => $request->name,
            'code' => $request->code,
            'interest_rate' => $request->interest_rate
        ]);
    }
}

