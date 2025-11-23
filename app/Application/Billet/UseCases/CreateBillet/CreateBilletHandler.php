<?php

namespace App\Application\Billet\UseCases\CreateBillet;

use App\Domain\Billet\Repositories\BilletRepository;

final class CreateBilletHandler
{
    public function __construct(
        private readonly BilletRepository $billetRepository
    )
    {
    }

    public function handle(CreateBilletRequest $request): void
    {
        $this->billetRepository->create([
            'payer_name' => $request->payer_name,
            'payer_document' => $request->payer_document,
            'recipient_name' => $request->recipient_name,
            'recipient_document' => $request->recipient_document,
            'amount' => $request->amount,
            'expiration_date' => $request->expiration_date,
            'observations' => $request->observations,
            'customer_id' => $request->customer_id,
            'bank_id' => $request->bank_id,
        ]);
    }
}

