<?php

namespace App\Repositories;

use App\Contracts\CityRepositoryInterface;
use Laravolt\Indonesia\Models\City;

class CityRepository implements CityRepositoryInterface
{
    public function getAll()
    {
        $City = City::select([
            'id',
            'name',
            'code',
        ])->paginate(10);

        return $City;
    }

}