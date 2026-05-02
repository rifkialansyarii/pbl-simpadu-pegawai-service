<?php

namespace App\Services;

use App\Contracts\CountryRepositoryInterface;

final class CountryService
{
    public function __construct(
        private CountryRepositoryInterface $repository
    ) {
    }

    public function getAllCountry()
    {
        return $this->repository->getAll();
    }
}