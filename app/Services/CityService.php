<?php

namespace App\Services;

use App\Contracts\CityRepositoryInterface;

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
}