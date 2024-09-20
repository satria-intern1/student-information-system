<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = ['kelas_id', 'user_id', 'kode_dosen', 'nip', 'name'];

    // Add the $with property for default eager loading

    protected static function boot()
    {
        parent::boot();

        //When a lecturer instance is being deleted, 
        //it checks if the instance has a related user and 
        //deletes the user instance as well.

        static::deleting(function ($lecturer) {
            if ($lecturer->user) {
                $lecturer->user->delete();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
}
