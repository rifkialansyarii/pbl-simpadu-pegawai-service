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

}