<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'country_name',
        'code',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
