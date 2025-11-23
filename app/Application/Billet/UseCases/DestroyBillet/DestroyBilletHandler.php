<?php

namespace App\Application\Billet\UseCases\DestroyBillet;

use App\Application\Billet\Exceptions\BilletNotFoundException;
use App\Domain\Billet\Repositories\BilletRepository;

final class DestroyBilletHandler
{
    public function __construct(
        private readonly BilletRepository $billetRepository
    ){}

    public function handle(DestroyBilletRequest $request): void
    {
        $this->billetRepository->delete($request->id);
    }
}

