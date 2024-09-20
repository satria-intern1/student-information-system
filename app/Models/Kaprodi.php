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

    protected static function boot()
    {
        parent::boot();

        //When a Kaprodi instance is being deleted, 
        //it checks if the instance has a related user and 
        //deletes the user instance as well.

        static::deleting(function ($kaprodi) {
            if ($kaprodi->user) {
                $kaprodi->user->delete();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
