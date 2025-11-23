<?php

namespace App\Application\Customer\UseCases\DestroyCustomer;

use App\Application\Customer\Exceptions\CustomerHasInvoicesException;
use App\Application\Customer\Exceptions\CustomerNotFoundException;
use App\Domain\Customer\Repositories\CustomerRepository;

final class DestroyCustomerHandler
{
    public function __construct(
        private readonly CustomerRepository $customerRepository
    ){}

    public function handle(DestroyCustomerRequest $request): void
    {
        $customer = $this->customerRepository->findById($request->id);

        if (is_null($customer)) {
            throw new CustomerNotFoundException();
        }

        if ($customer->billets()->count() > 0) {
            throw new CustomerHasInvoicesException();
        }

        $this->customerRepository->delete($request->id);
    }
}

