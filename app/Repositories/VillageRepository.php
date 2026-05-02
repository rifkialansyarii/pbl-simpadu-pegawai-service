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

}