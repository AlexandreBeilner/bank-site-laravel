<?php

namespace App\Application\Customer\UseCases\CreateCustomer;

use App\Domain\Customer\Repositories\CustomerRepository;

final class CreateCustomerHandler
{
    public function __construct(
        private readonly CustomerRepository $customerRepository
    )
    {
    }

    public function handle(CreateCustomerRequest $request): void
    {
        $this->customerRepository->create([
            'name' => $request->name,
            'email' => $request->email
        ]);
    }
}

