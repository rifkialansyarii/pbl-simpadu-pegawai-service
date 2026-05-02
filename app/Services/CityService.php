<?php

namespace App\Services;

use App\Contracts\CityRepositoryInterface;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Province;

final class CityService
{
    public function __construct(
        private CityRepositoryInterface $repository
    ) {
    }

    public function getAllCity()
    {
        return $this->repository->getAll();
    }

    public function getCityByProvince(string $provinceCode)
    {
        return $this->repository->getByParent($provinceCode);
    }
}