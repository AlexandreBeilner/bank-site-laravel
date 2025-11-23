<?php

namespace App\Application\Billet\UseCases\ShowBillet;

use App\Application\Billet\Exceptions\BilletNotFoundException;
use App\Domain\Billet\Repositories\BilletRepository;

final class ShowBilletHandler
{
    public function __construct(
        private readonly BilletRepository $billetRepository
    ){}

    public function handle(ShowBilletRequest $request): ShowBilletResponse
    {
        $billet = $this->billetRepository->findById($request->id);

        if (is_null($billet)) {
            throw new BilletNotFoundException();
        }

        return new ShowBilletResponse($billet);
    }
}

