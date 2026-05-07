<?php

namespace App\Repositories;

use App\Contracts\CountryRepositoryInterface;
use App\Models\Country;

class CountryRepository implements CountryRepositoryInterface
{
    public function getAll()
    {
        $country = Country::select([
            'id',
            'name',
            'code',
        ])->paginate(10);

        return $country;
    }
}