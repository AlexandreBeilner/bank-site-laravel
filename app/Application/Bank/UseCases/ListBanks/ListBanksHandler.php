<?php

namespace App\Application\Bank\UseCases\ListBanks;

use App\Domain\Bank\Repositories\BankRepository;

final class ListBanksHandler
{
    public function __construct(
        private readonly BankRepository $bankRepository
    ){}

    public function handle(ListBanksRequest $request): ListBanksResponse
    {
        $paginator = $this->bankRepository->paginateWithFilters(
            search: $request->search,
            page: $request->page,
            perPage: $request->perPage,
            orderBy: $request->orderBy,
            direction: $request->direction
        );

        return new ListBanksResponse($paginator);
    }
}

