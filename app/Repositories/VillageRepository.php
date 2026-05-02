<?php

namespace App\Repositories;

use App\Contracts\VillageRepositoryInterface;
use Laravolt\Indonesia\Models\Village;

class VillageRepository implements VillageRepositoryInterface
{
    public function getAll()
    {
        $Village = Village::select([
            'id',
            'name',
            'code',
        ])->paginate(10);

        return $Village;
    }

    public function getByParent(string $districtCode)
    {          
        $village = Village::select([
            'id',
            'code',
            'name',
            'district_code'
        ])->where('district_code', $districtCode)->paginate(10);

        return $village->load('district');
    }
}