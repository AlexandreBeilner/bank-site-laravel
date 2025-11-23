<?php

namespace App\Infrastructure\Customer\Providers;

use App\Domain\Customer\Repositories\CustomerRepository;
use App\Infrastructure\Customer\Persistence\Eloquent\CustomerEloquentRepository;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CustomerRepository::class, CustomerEloquentRepository::class);
    }
}
