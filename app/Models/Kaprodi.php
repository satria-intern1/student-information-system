<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kaprodi extends Model
{
    use HasFactory;

    protected $fillable = ['kode_dosen', 'nip', 'name', 'user_id'];

    // Add the $with property for default eager loading
    // protected $with = ['user',];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
