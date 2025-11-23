<?php

namespace App\Infrastructure\Billing\Providers;

use App\Domain\Billing\Repositories\BillingServiceRepository;
use App\Domain\Billing\Repositories\BillingInstallmentRepository;
use App\Domain\Billing\Services\BillingServiceInterface;
use App\Domain\Billing\Services\Impl\BillingService;
use App\Infrastructure\Billing\Persistence\Eloquent\BillingInstallmentEloquentRepository;
use App\Infrastructure\Billing\Persistence\Eloquent\BillingServiceEloquentRepository;
use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BillingServiceRepository::class, BillingServiceEloquentRepository::class);
        $this->app->bind(BillingInstallmentRepository::class, BillingInstallmentEloquentRepository::class);
        $this->app->bind(BillingServiceInterface::class, BillingService::class);
    }
}
