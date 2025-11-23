<?php

namespace App\Infrastructure\Bank\Providers;

use App\Domain\Bank\Repositories\BankRepository;
use App\Infrastructure\Bank\Persistence\Eloquent\BankEloquentRepository;
use Illuminate\Support\ServiceProvider;

class BankServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BankRepository::class, BankEloquentRepository::class);
    }
}
