<?php

namespace App\Application\Customer\UseCases\UpdateCustomer;

use App\Domain\Customer\Repositories\CustomerRepository;

final class UpdateCustomerHandler
{
    public function __construct(
        private readonly CustomerRepository $customerRepository
    ){}

    public function handle(UpdateCustomerRequest $request): void
    {
        $this->customerRepository->update($request->id, [
            'name'     => $request->name,
            'email'    => $request->email
        ]);
    }
}

