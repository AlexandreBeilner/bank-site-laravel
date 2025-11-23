<?php

namespace App\Application\Customer\UseCases\ListCustomers;

use App\Domain\Customer\Repositories\CustomerRepository;

final class ListCustomersHandler
{
    public function __construct(
        private readonly CustomerRepository $customerRepository
    ){}

    public function handle(ListCustomersRequest $request): ListCustomersResponse
    {
        $paginator = $this->customerRepository->paginateWithFilters(
            search: $request->search,
            page: $request->page,
            perPage: $request->perPage,
            orderBy: $request->orderBy,
            direction: $request->direction
        );

        return new ListCustomersResponse($paginator);
    }
}

