<?php

namespace App\Contracts;


interface DistrictRepositoryInterface
{
    public function getAll();
    public function getByParent(string $cityCode);
}