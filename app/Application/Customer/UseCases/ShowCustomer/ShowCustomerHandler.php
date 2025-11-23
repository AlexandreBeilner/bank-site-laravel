<?php

namespace App\Application\Customer\UseCases\ShowCustomer;

use App\Application\Customer\Exceptions\CustomerNotFoundException;
use App\Domain\Customer\Repositories\CustomerRepository;

final class ShowCustomerHandler
{
    public function __construct(
        private readonly CustomerRepository $customerRepository
    ){}

    public function handle(ShowCustomerRequest $request): ShowCustomerResponse
    {
        $customer = $this->customerRepository->findById($request->id);

        if (is_null($customer)) {
            throw new CustomerNotFoundException();
        }

        return new ShowCustomerResponse($customer);
    }
}

