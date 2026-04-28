<?php

namespace App\Providers;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Contracts\EmployeeRepositoryInterface;
use App\Repositories\ChangeRequestRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(ChangeRequestRepositoryInterface::class, ChangeRequestRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
