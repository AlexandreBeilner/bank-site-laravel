<?php

namespace App\Application\Bank\UseCases\DestroyBank;

use App\Application\Bank\Exceptions\BankHasBilletsException;
use App\Application\Bank\Exceptions\BankNotFoundException;
use App\Domain\Bank\Repositories\BankRepository;

final class DestroyBankHandler
{
    public function __construct(
        private readonly BankRepository $bankRepository
    ){}

    public function handle(DestroyBankRequest $request): void
    {
        $bank = $this->bankRepository->findByIdWithBilletCount($request->id);

        if (is_null($bank)) {
            throw new BankNotFoundException();
        }

        if ($bank->billets_count > 0) {
            throw new BankHasBilletsException();
        }

        $this->bankRepository->delete($request->id);
    }
}

