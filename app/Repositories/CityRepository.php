<?php

namespace App\Repositories;

use App\Contracts\CityRepositoryInterface;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Province;

class CityRepository implements CityRepositoryInterface
{
    public function getAll()
    {
        $city = City::select([
            'id',
            'name',
            'code',
            'province_code',
        ])->paginate(10);

        $city->load('province');

        return $city;
    }

    public function getByParent(string $provinceCode)
    {          
        $city = City::select([
            'id',
            'code',
            'name',
            'province_code'
        ])->where('province_code', $provinceCode)->paginate(10);

        $city->load('province');
        return $city;
    }


}