<?php

namespace App\Providers;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Contracts\CityRepositoryInterface;
use App\Contracts\ClassSessionRepositoryInterface;
use App\Contracts\CountryRepositoryInterface;
use App\Contracts\DistrictRepositoryInterface;
use App\Contracts\EmployeeRepositoryInterface;
use App\Contracts\LearningMaterialRepositoryInterface;
use App\Contracts\ProvinceRepositoryInterface;
use App\Contracts\VillageRepositoryInterface;
use App\Repositories\ChangeRequestRepository;
use App\Repositories\CityRepository;
use App\Repositories\ClassSessionRepository;
use App\Repositories\CountryRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\LearningMaterialRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\VillageRepository;
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
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(ProvinceRepositoryInterface::class, ProvinceRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(DistrictRepositoryInterface::class, DistrictRepository::class);
        $this->app->bind(VillageRepositoryInterface::class, VillageRepository::class);
        $this->app->bind(ClassSessionRepositoryInterface::class, ClassSessionRepository::class);
        $this->app->bind(LearningMaterialRepositoryInterface::class, LearningMaterialRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
