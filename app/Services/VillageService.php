<?php

namespace App\Services;

use App\Contracts\VillageRepositoryInterface;

final class VillageService
{
    public function __construct(
        private VillageRepositoryInterface $repository
    ) {
    }

    public function getAllVillage()
    {
        return $this->repository->getAll();
    }

    public function getVillageByDistrict(string $districtCode)
    {
        return $this->repository->getByParent($districtCode);
    }
}