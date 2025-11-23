<?php

namespace App\Infrastructure\Billet\Providers;

use App\Domain\Billet\Repositories\BilletRepository;
use App\Infrastructure\Billet\Persistence\Eloquent\BilletEloquentRepository;
use Illuminate\Support\ServiceProvider;

class BilletServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BilletRepository::class, BilletEloquentRepository::class);
    }
}
