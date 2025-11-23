<?php

namespace App\Application\Billet\UseCases\ListBillets;

use App\Domain\Billet\Repositories\BilletRepository;

final class ListBilletsHandler
{
    public function __construct(
        private readonly BilletRepository $billetRepository
    ){}

    public function handle(ListBilletsRequest $request): ListBilletsResponse
    {
        $paginator = $this->billetRepository->paginateWithFilters(
            search: $request->search,
            page: $request->page,
            perPage: $request->perPage,
            orderBy: $request->orderBy,
            direction: $request->direction
        );

        return new ListBilletsResponse($paginator);
    }
}

