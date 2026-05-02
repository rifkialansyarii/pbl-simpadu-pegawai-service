<?php

namespace App\Services;

use App\Contracts\ProvinceRepositoryInterface;

final class ProvinceService
{
    public function __construct(
        private ProvinceRepositoryInterface $repository
    ) {
    }

    public function getAllProvince()
    {
        return $this->repository->getAll();
    }
}