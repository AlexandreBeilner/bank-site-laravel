<?php

namespace App\Application\Customer\UseCases\ShowCustomer;

use App\Domain\Customer\Repositories\CustomerRepository;

final class ShowCustomerHandler
{
    public function __construct(
        private readonly CustomerRepository $customerRepository
    ){}

    public function handle(ShowCustomerRequest $request): ShowCustomerResponse
    {
        $customer = $this->customerRepository->findById($request->id);

        return new ShowCustomerResponse($customer);
    }
}

