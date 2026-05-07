<?php

namespace App\Repositories;

use App\Contracts\DistrictRepositoryInterface;
use Laravolt\Indonesia\Models\District;

class DistrictRepository implements DistrictRepositoryInterface
{
    public function getAll()
    {
        $district = District::select([
            'id',
            'name',
            'code',
            'city_code',
        ])->paginate(10);

        $district->load('city');
        return $district;
    }

    public function getByParent(string $cityCode)
    {          
        $district = District::select([
            'id',
            'code',
            'name',
            'city_code'
        ])->where('city_code', $cityCode)->paginate(10);

        
        $district->load('city');
        return $district;
    }
}