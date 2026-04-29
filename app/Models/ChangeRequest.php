<?php

namespace App\Models;

use App\Policies\ChangeRequestPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[UsePolicy(ChangeRequestPolicy::class)]
class ChangeRequest extends Model
{
    /** @use HasFactory<\Database\Factories\ChangeRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'field_name',
        'old_value',
        'new_value',
        'status'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
