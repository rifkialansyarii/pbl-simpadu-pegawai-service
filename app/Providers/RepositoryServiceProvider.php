<?php

namespace App\Providers;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Contracts\CityRepositoryInterface;
use App\Contracts\ClassSessionRepositoryInterface;
use App\Contracts\CountryRepositoryInterface;
use App\Contracts\DistrictRepositoryInterface;
use App\Contracts\EmployeeRepositoryInterface;
use App\Contracts\FileUploadRepositoryInterface;
use App\Contracts\GradeSettingRepositoryInterface;
use App\Contracts\ProvinceRepositoryInterface;
use App\Contracts\StudentAssignmentRepositoryInterface;
use App\Contracts\StudentSubmissionRepositoryInterface;
use App\Contracts\VillageRepositoryInterface;
use App\Repositories\ChangeRequestRepository;
use App\Repositories\CityRepository;
use App\Repositories\ClassSessionRepository;
use App\Repositories\CountryRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\FileUploadRepository;
use App\Repositories\GradeSettingRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\StudentAssignmentRepository;
use App\Repositories\StudentSubmissionRepository;
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
        $this->app->bind(FileUploadRepositoryInterface::class, FileUploadRepository::class);
        $this->app->bind(StudentAssignmentRepositoryInterface::class, StudentAssignmentRepository::class);
        $this->app->bind(StudentSubmissionRepositoryInterface::class, StudentSubmissionRepository::class);
        $this->app->bind(GradeSettingRepositoryInterface::class, GradeSettingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
