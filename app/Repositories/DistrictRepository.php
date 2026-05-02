<?php

namespace App\Repositories;

use App\Contracts\DistrictRepositoryInterface;
use Laravolt\Indonesia\Models\District;

class DistrictRepository implements DistrictRepositoryInterface
{
    public function getAll()
    {
        $District = District::select([
            'id',
            'name',
            'code',
        ])->paginate(10);

        return $District;
    }

    public function getByParent(string $cityCode)
    {          
        $district = District::select([
            'id',
            'code',
            'name',
            'city_code'
        ])->where('city_code', $cityCode)->paginate(10);

        return $district->load('city');
    }
}