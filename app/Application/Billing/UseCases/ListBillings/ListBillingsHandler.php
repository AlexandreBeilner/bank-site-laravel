<?php

namespace App\Application\Billing\UseCases\ListBillings;

use App\Domain\Billing\Repositories\BillingServiceRepository;

final class ListBillingsHandler
{
    public function __construct(
        private readonly BillingServiceRepository $billingServiceRepository
    ){}

    public function handle(ListBillingsRequest $request): ListBillingsResponse
    {
        $paginator = $this->billingServiceRepository->paginateWithFilters(
            search: $request->search,
            page: $request->page,
            perPage: $request->perPage,
            orderBy: $request->orderBy,
            direction: $request->direction
        );

        return new ListBillingsResponse($paginator);
    }
}

