<?php

namespace App\Repositories;

use App\Contracts\ProvinceRepositoryInterface;
use Laravolt\Indonesia\Models\Province;

class ProvinceRepository implements ProvinceRepositoryInterface
{
    public function getAll()
    {
        $province = Province::select([
            'id',
            'name',
            'code',
        ])->paginate(10);

        return $province;
    }

}