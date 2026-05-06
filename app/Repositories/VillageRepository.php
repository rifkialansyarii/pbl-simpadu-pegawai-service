<?php

namespace App\Repositories;

use App\Contracts\VillageRepositoryInterface;
use Laravolt\Indonesia\Models\Village;

class VillageRepository implements VillageRepositoryInterface
{
    public function getAll()
    {
        $village = Village::select([
            'id',
            'name',
            'code',
            'district_code',
        ])->paginate(10);

        $village->load('district');
        return $village;
    }

    public function getByParent(string $districtCode)
    {         
        $village = Village::select([
            'id',
            'code',
            'name',
            'district_code'
        ])->where('district_code', $districtCode)->paginate(10);
        
        $village->load('district');
        return $village;
    }
}