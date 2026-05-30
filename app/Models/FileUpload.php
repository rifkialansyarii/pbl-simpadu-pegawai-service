<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FileUpload extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'file_path',
        'original_file_name',
        'file_size',
        'mime_type',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function classSessions(): BelongsToMany
    {
        return $this->belongsToMany(ClassSession::class, 'session_materials')->withTimestamps();
    }
}
