<?php

namespace App\Application\Bank\UseCases\ShowBank;

use App\Application\Bank\Exceptions\BankNotFoundException;
use App\Domain\Bank\Repositories\BankRepository;

final class ShowBankHandler
{
    public function __construct(
        private readonly BankRepository $bankRepository
    ){}

    public function handle(ShowBankRequest $request): ShowBankResponse
    {
        $bank = $this->bankRepository->findById($request->id);

        if (is_null($bank)) {
            throw new BankNotFoundException();
        }

        return new ShowBankResponse($bank);
    }
}

