<?php

namespace App\Contracts;

use Laravolt\Indonesia\Models\City;

interface CityRepositoryInterface
{
    public function getAll();
    public function getByParent(string $provinceCode);
}