<?php

namespace App\Contracts;

interface VillageRepositoryInterface
{
    public function getAll();
    public function getByParent(string $districtCode);
}