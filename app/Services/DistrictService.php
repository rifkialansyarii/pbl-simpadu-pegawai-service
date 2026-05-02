<?php

namespace App\Services;

use App\Contracts\DistrictRepositoryInterface;

final class DistrictService
{
    public function __construct(
        private DistrictRepositoryInterface $repository
    ) {
    }

    public function getAllDistrict()
    {
        return $this->repository->getAll();
    }

    public function getDistrictByCity(string $cityCode)
    {
        return $this->repository->getByParent($cityCode);
    }
}